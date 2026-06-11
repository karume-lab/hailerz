<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use NumberFormatter;

class CurrencyHelper
{
    /**
     * Get live exchange rates cached daily.
     */
    public static function getRates(): array
    {
        return Cache::remember('exchange_rates_usd_live', 86400, function () {
            try {
                $response = Http::timeout(3)->get('https://open.er-api.com/v6/latest/USD');
                if ($response->successful() && $response->json('rates')) {
                    return $response->json('rates');
                }
            } catch (\Exception $e) {
                Log::warning('Exchange rate API fetch failed: '.$e->getMessage());
            }

            // Fallback safe rates if API fails
            return [
                'USD' => 1.0,
                'GBP' => 0.80,
                'EUR' => 0.92,
                'NGN' => 1500.0,
                'KES' => 130.0,
                'ZAR' => 19.0,
            ];
        });
    }

    /**
     * Get the detected currency code for the current user's request context.
     */
    public static function getUserCurrency(): string
    {
        $rates = self::getRates();

        // 1. Check if stored in session
        if (session()->has('user_currency')) {
            $sess = session()->get('user_currency');
            if (array_key_exists($sess, $rates)) {
                return $sess;
            }
        }

        // 2. Try to detect via Cloudflare or other request headers
        $countryCode = request()->header('CF-IPCountry');
        if ($countryCode) {
            $currency = self::getCurrencyByCountry($countryCode);
            if ($currency && array_key_exists($currency, $rates)) {
                session()->put('user_currency', $currency);

                return $currency;
            }
        }

        // 3. Try IP lookup using a fast GeoIP API (cached for 24 hours)
        $ip = request()->ip();

        // If testing locally, use the server's external IP for geolocation instead of passing 127.0.0.1
        $isLocal = ($ip === '127.0.0.1' || $ip === '::1' || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.'));
        $cacheKey = $isLocal ? 'ip_currency_local' : 'ip_currency_'.str_replace([':', '.'], '_', $ip);
        $endpoint = $isLocal ? 'https://ipapi.co/currency/' : "https://ipapi.co/{$ip}/currency/";

        $detected = Cache::remember($cacheKey, 86400, function () use ($endpoint) {
            try {
                $response = Http::timeout(2)->get($endpoint);
                if ($response->successful() && strlen(trim($response->body())) === 3) {
                    return strtoupper(trim($response->body()));
                }
            } catch (\Exception $e) {
                Log::warning("IP Geolocation failed for endpoint {$endpoint}: ".$e->getMessage());
            }

            return null;
        });

        if ($detected && array_key_exists($detected, $rates)) {
            session()->put('user_currency', $detected);

            return $detected;
        }

        // Default to USD
        return 'USD';
    }

    /**
     * Helper to map country code to currency.
     */
    private static function getCurrencyByCountry(string $countryCode): ?string
    {
        $countryCode = strtoupper($countryCode);
        $map = [
            'NG' => 'NGN', 'GB' => 'GBP', 'KE' => 'KES', 'ZA' => 'ZAR', 'UG' => 'UGX', 'TZ' => 'TZS',
        ];
        if (isset($map[$countryCode])) {
            return $map[$countryCode];
        }

        $euroCountries = ['AT', 'BE', 'CY', 'EE', 'FI', 'FR', 'DE', 'GR', 'IE', 'IT', 'LV', 'LT', 'LU', 'MT', 'NL', 'PT', 'SK', 'SI', 'ES'];
        if (in_array($countryCode, $euroCountries)) {
            return 'EUR';
        }

        return null; // let IP lookup handle the rest
    }

    /**
     * Convert an amount from USD base to target currency.
     */
    public static function convert(float $amount, ?string $toCurrency = null): float
    {
        $toCurrency = $toCurrency ?: self::getUserCurrency();
        $rates = self::getRates();
        $rate = $rates[strtoupper($toCurrency)] ?? 1.0;

        return $amount * $rate;
    }

    /**
     * Format starting price base values from USD to user local currency dynamically.
     */
    public static function format(float $amount, ?string $toCurrency = null): string
    {
        $toCurrency = $toCurrency ?: self::getUserCurrency();
        $converted = self::convert($amount, $toCurrency);

        $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

        $formatted = $fmt->formatCurrency($converted, $toCurrency);

        // Minor patch to convert 'KES' to 'Ksh' if desired for local aesthetic
        if ($toCurrency === 'KES') {
            $formatted = str_replace('KES', 'Ksh', $formatted);
        }
        if ($toCurrency === 'NGN') {
            $formatted = str_replace('NGN', '₦', $formatted);
        }

        return $formatted;
    }

    /**
     * Format a minimum and maximum rate range for talent submissions.
     */
    public static function formatRange(float $min, float $max, string $currencyCode): string
    {
        return self::format($min, $currencyCode).' - '.self::format($max, $currencyCode);
    }

    /**
     * Clean rounding function for dynamic budget ranges.
     * e.g. rounds 129450 to 130000.
     */
    private static function cleanRound(float $amount): float
    {
        if ($amount <= 0) {
            return 0;
        }

        $magnitude = floor(log10($amount));
        $factor = pow(10, max(0, $magnitude - 1));

        if ($factor < 10) {
            return ceil($amount / 10) * 10;
        }

        return ceil($amount / $factor) * $factor;
    }

    /**
     * Localized budget range options tailored dynamically to each currency scale.
     */
    public static function getBudgetOptions(?string $currency = null): array
    {
        $currency = $currency ?: self::getUserCurrency();

        // Base USD ranges
        $baseRanges = [
            [0, 1000],
            [1000, 2500],
            [2500, 5000],
            [5000, 7500],
            [7500, 10000],
            [10000, 15000],
            [15000, 20000],
            [20000, null],
        ];

        $options = [];
        foreach ($baseRanges as $range) {
            $minBase = $range[0];
            $maxBase = $range[1];

            $minConverted = self::cleanRound(self::convert($minBase, $currency));

            if ($maxBase === null) {
                $options[] = self::format($minConverted, $currency).'+';
            } else {
                $maxConverted = self::cleanRound(self::convert($maxBase, $currency));
                if ($minBase == 0) {
                    $options[] = 'Under '.self::format($maxConverted, $currency);
                } else {
                    $options[] = self::format($minConverted, $currency).' - '.self::format($maxConverted, $currency);
                }
            }
        }

        return $options;
    }

    /**
     * Convert an amount from any currency to base USD currency.
     */
    public static function convertToUsd(float $amount, string $fromCurrency): float
    {
        $rates = self::getRates();
        $rate = $rates[strtoupper($fromCurrency)] ?? 1.0;

        return $rate > 0 ? ($amount / $rate) : $amount;
    }

    /**
     * Get the currency symbol for the current user's detected currency.
     */
    public static function getCurrencySymbol(): string
    {
        return self::getCurrencySymbolForCode(self::getUserCurrency());
    }

    /**
     * Get the symbol for a specific currency code.
     */
    public static function getCurrencySymbolForCode(string $code): string
    {
        $code = strtoupper($code);
        $symbols = [
            'USD' => '$',
            'GBP' => '£',
            'EUR' => '€',
            'NGN' => '₦',
            'KES' => 'Ksh',
            'ZAR' => 'R',
        ];

        if (isset($symbols[$code])) {
            return $symbols[$code];
        }

        $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        $formatted = $fmt->formatCurrency(0, $code);
        $symbol = preg_replace('/[0-9.,\s\xc2\xa0]/', '', $formatted);

        return $symbol ?: $code;
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
