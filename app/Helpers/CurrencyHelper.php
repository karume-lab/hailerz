<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CurrencyHelper
{
    protected static $currencies = [
        'USD' => ['symbol' => '$', 'rate' => 1.0],
        'GBP' => ['symbol' => '£', 'rate' => 0.80],
        'EUR' => ['symbol' => '€', 'rate' => 0.92],
        'NGN' => ['symbol' => '₦', 'rate' => 1500.0],
    ];

    /**
     * Get the detected currency code for the current user's request context.
     */
    public static function getUserCurrency(): string
    {
        // 1. Check if stored in session
        if (session()->has('user_currency')) {
            $sess = session()->get('user_currency');
            if (array_key_exists($sess, self::$currencies)) {
                return $sess;
            }
        }

        // 2. Try to detect via Cloudflare or other request headers
        $countryCode = request()->header('CF-IPCountry');
        if ($countryCode) {
            $currency = self::getCurrencyByCountry($countryCode);
            session()->put('user_currency', $currency);
            return $currency;
        }

        // 3. Detect via HTTP_ACCEPT_LANGUAGE
        $acceptLanguage = request()->server('HTTP_ACCEPT_LANGUAGE');
        if ($acceptLanguage) {
            if (str_contains($acceptLanguage, 'NG') || str_contains($acceptLanguage, 'ng') || str_contains($acceptLanguage, 'Naira')) {
                session()->put('user_currency', 'NGN');
                return 'NGN';
            }
            if (str_contains($acceptLanguage, 'GB') || str_contains($acceptLanguage, 'gb') || str_contains($acceptLanguage, 'en-GB')) {
                session()->put('user_currency', 'GBP');
                return 'GBP';
            }
            // Euro countries
            if (preg_match('/(DE|FR|ES|IT|NL|BE|PT|IE|AT|FI|GR|LU|SK|SI|EE|LV|LT|CY|MT|de|fr|es|it|nl|be|pt|ie|at|fi|gr|lu|sk|si|ee|lv|lt|cy|mt)/', $acceptLanguage)) {
                session()->put('user_currency', 'EUR');
                return 'EUR';
            }
        }

        // 4. Try IP lookup using a fast GeoIP API (cached for 24 hours)
        $ip = request()->ip();
        if ($ip && $ip !== '127.0.0.1' && $ip !== '::1' && !str_starts_with($ip, '192.168.') && !str_starts_with($ip, '10.')) {
            $cacheKey = 'ip_currency_' . str_replace([':', '.'], '_', $ip);
            $detected = Cache::remember($cacheKey, 86400, function () use ($ip) {
                try {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://ipapi.co/{$ip}/currency/");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt_array($ch, [
                        CURLOPT_TIMEOUT => 2, // fast timeout
                        CURLOPT_CONNECTTIMEOUT => 1,
                    ]);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    if ($response && strlen(trim($response)) === 3) {
                        $curr = strtoupper(trim($response));
                        if (array_key_exists($curr, self::$currencies)) {
                            return $curr;
                        }
                    }
                } catch (\Exception $e) {
                    Log::warning("IP Geolocation failed for IP {$ip}: " . $e->getMessage());
                }
                return null;
            });

            if ($detected) {
                session()->put('user_currency', $detected);
                return $detected;
            }
        }

        // Default to USD
        return 'USD';
    }

    /**
     * Get the currency symbol for the current user's detected currency.
     */
    public static function getCurrencySymbol(): string
    {
        $currency = self::getUserCurrency();
        return self::$currencies[$currency]['symbol'] ?? '$';
    }

    /**
     * Get the symbol for a specific currency code (e.g. 'NGN' -> '₦').
     */
    public static function getCurrencySymbolForCode(string $code): string
    {
        return self::$currencies[strtoupper($code)]['symbol'] ?? '$';
    }

    /**
     * Helper to map country code to currency.
     */
    private static function getCurrencyByCountry(string $countryCode): string
    {
        $countryCode = strtoupper($countryCode);
        if ($countryCode === 'NG') return 'NGN';
        if ($countryCode === 'GB') return 'GBP';
        
        $euroCountries = ['AT', 'BE', 'CY', 'EE', 'FI', 'FR', 'DE', 'GR', 'IE', 'IT', 'LV', 'LT', 'LU', 'MT', 'NL', 'PT', 'SK', 'SI', 'ES'];
        if (in_array($countryCode, $euroCountries)) return 'EUR';

        return 'USD';
    }

    /**
     * Convert an amount from USD base to target currency.
     */
    public static function convert(float $amount, string $toCurrency = null): float
    {
        $toCurrency = $toCurrency ?: self::getUserCurrency();
        $rate = self::$currencies[strtoupper($toCurrency)]['rate'] ?? 1.0;
        return $amount * $rate;
    }

    /**
     * Format starting price base values from USD to user local currency dynamically.
     */
    public static function format(float $amount, string $toCurrency = null): string
    {
        $toCurrency = $toCurrency ?: self::getUserCurrency();
        $symbol = self::$currencies[strtoupper($toCurrency)]['symbol'] ?? '$';
        $converted = self::convert($amount, $toCurrency);
        return $symbol . number_format($converted, 0);
    }

    /**
     * Format a minimum and maximum rate range for talent submissions.
     */
    public static function formatRange(float $min, float $max, string $currencyCode): string
    {
        $symbol = self::getCurrencySymbolForCode($currencyCode);
        return $symbol . number_format($min, 0) . ' - ' . $symbol . number_format($max, 0);
    }

    /**
     * Localized budget range options tailored to each currency scale.
     */
    public static function getBudgetOptions(string $currency = null): array
    {
        $currency = $currency ?: self::getUserCurrency();
        if ($currency === 'NGN') {
            return [
                'Under ₦1,500,000',
                '₦1,500,000 - ₦3,750,000',
                '₦3,750,000 - ₦7,500,000',
                '₦7,500,000 - ₦11,250,000',
                '₦11,250,000 - ₦15,000,000',
                '₦15,000,000 - ₦22,500,000',
                '₦22,500,000 - ₦30,000,000',
                '₦30,000,000+',
            ];
        }
        if ($currency === 'GBP') {
            return [
                'Under £800',
                '£800 - £2,000',
                '£2,000 - £4,000',
                '£4,000 - £6,000',
                '£6,000 - £8,000',
                '£8,000 - £12,000',
                '£12,000 - £16,000',
                '£16,000+',
            ];
        }
        if ($currency === 'EUR') {
            return [
                'Under €900',
                '€900 - €2,300',
                '€2,300 - €4,600',
                '€4,600 - €6,900',
                '€6,900 - €9,200',
                '€9,200 - €13,800',
                '€13,800 - €18,400',
                '€18,400+',
            ];
        }
        // USD (Default)
        return [
            'Under $1,000',
            '$1,000 - $2,500',
            '$2,500 - $5,000',
            '$5,000 - $7,500',
            '$7,500 - $10,000',
            '$10,000 - $15,000',
            '$15,000 - $20,000',
            '$20,000+',
        ];
    }

    /**
     * Convert an amount from any currency to base USD currency.
     */
    public static function convertToUsd(float $amount, string $fromCurrency): float
    {
        $rate = self::$currencies[strtoupper($fromCurrency)]['rate'] ?? 1.0;
        return $rate > 0 ? ($amount / $rate) : $amount;
    }

    /**
     * Convert currency symbols to safe HTML entities for reliable PDF rendering.
     */
    public static function getPdfSafeString(string $str): string
    {
        $replacements = [
            '₦' => '&#8358;',
            '£' => '&#163;',
            '€' => '&#8364;',
            '$' => '&#36;',
        ];
        return str_replace(array_keys($replacements), array_values($replacements), $str);
    }
}
