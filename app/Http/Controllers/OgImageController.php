<?php

namespace App\Http\Controllers;

use App\Models\Talent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class OgImageController extends Controller
{
    /**
     * Generate and stream the Open Graph image for a talent.
     * Fixed for MySQL 'database' cache driver by using base64 encoding to avoid 
     * 'Incorrect string value' errors with binary data.
     */
    public function show(string $slug)
    {
        $talent = Talent::where('slug', $slug)->firstOrFail();
        
        // Bump cache key version to v4 to clear out any corrupted data
        $cacheKey = "talent_og_v4_{$talent->id}";

        // Cache the BASE64 encoded string, NOT the raw binary
        $base64Image = Cache::remember($cacheKey, 86400, function () use ($talent) {
            try {
                $manager = new ImageManager(new Driver());

                // 1. Fetch Remote Image using profile_photo_url accessor
                $sourceUrl = $talent->profile_photo_url;
                $imageData = null;

                try {
                    // Fetch remote image with a 10s timeout
                    $response = Http::timeout(10)->get($sourceUrl);
                    if ($response->successful()) {
                        $imageData = $response->body();
                    }
                } catch (\Exception $e) {
                    Log::warning("OG Fetch failed for talent {$talent->id}: " . $e->getMessage());
                }

                // 2. Load or Create Canvas
                if (!$imageData) {
                    // Fallback to solid canvas if fetch fails
                    $image = $manager->createImage(1200, 630)->fill('223757');
                } else {
                    // Using decode() for v4 compatibility as established in previous fixes
                    $image = $manager->decode($imageData);
                }

                // 3. Composite Logic (1200x630 OG dimensions)
                $image->cover(1200, 630);

                // 4. Dark Overlay (v4 drawRectangle syntax)
                $image->drawRectangle(function ($rect) {
                    $rect->at(0, 0);
                    $rect->size(1200, 630);
                    $rect->background('rgba(0, 0, 0, 0.4)');
                });

                // 5. Place Logo (Top-Left, 40, 40)
                $logoPath = public_path('images/logo.webp');
                if (file_exists($logoPath)) {
                    $logo = $manager->decode($logoPath);
                    $logo->scale(height: 80);
                    // In v4, insert() is used for placing overlays
                    $image->insert($logo, 40, 40, 'top-left');
                }

                // Return the BASE64 encoded string so MySQL accepts it
                return base64_encode($image->encodeUsingMediaType('image/webp')->toString());

            } catch (\Throwable $e) {
                Log::error("Critical OG generation failure for talent {$talent->id}: " . $e->getMessage());
                
                // Final bulletproof fallback: return a basic solid color canvas (base64 encoded)
                try {
                    $manager = new ImageManager(new Driver());
                    $fallbackBytes = $manager->createImage(1200, 630)
                        ->fill('223757')
                        ->encodeUsingMediaType('image/webp')
                        ->toString();
                    return base64_encode($fallbackBytes);
                } catch (\Exception $finalError) {
                    return null;
                }
            }
        });

        if (!$base64Image) {
            return Response::make('', 404);
        }

        // Decode the base64 string back into binary bytes for the browser
        $imageBytes = base64_decode($base64Image);

        return Response::make($imageBytes, 200, [
            'Content-Type'  => 'image/webp',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
