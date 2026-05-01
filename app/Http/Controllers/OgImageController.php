<?php

namespace App\Http\Controllers;

use App\Models\Talent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class OgImageController extends Controller
{
    public function show(string $slug)
    {
        $talent = Talent::where('slug', $slug)->firstOrFail();

        // If GD is not available, redirect to the ui-avatars fallback immediately
        if (!extension_loaded('gd')) {
            $name = urlencode($talent->name);
            return redirect("https://ui-avatars.com/api/?name={$name}&background=223757&color=ffffff&size=1200&format=png&bold=true&font-size=0.35");
        }

        /** @var int $talentId */
        $talentId = $talent->id;
        $cacheKey = "talent_og_image_bytes_{$talentId}";

        // Cache the raw webp bytes (not the Response object)
        $imageBytes = Cache::remember($cacheKey, 86400, function () use ($talent) {
            return $this->generateOgImage($talent);
        });

        if (!$imageBytes) {
            $name = urlencode($talent->name);
            return redirect("https://ui-avatars.com/api/?name={$name}&background=223757&color=ffffff&size=1200&format=png&bold=true&font-size=0.35");
        }

        return Response::make($imageBytes, 200, [
            'Content-Type'  => 'image/webp',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }

    private function generateOgImage(Talent $talent): ?string
    {
        try {
            $managerClass = \Intervention\Image\ImageManager::class;
            $driverClass  = \Intervention\Image\Drivers\Gd\Driver::class;
            $manager = $managerClass::usingDriver($driverClass);

            /** @var int $talentId */
            $talentId = $talent->id;

            // 1. Determine the source image
            $source = $talent->primary_image_url
                ?: $talent->getFirstMediaUrl('primary_image', 'optimized');

            $imageData = null;

            // Try to fetch the primary image if it exists
            if ($source) {
                try {
                    if (filter_var($source, FILTER_VALIDATE_URL)) {
                        $response = Http::timeout(10)->get($source);
                        if ($response->successful()) {
                            $imageData = $response->body();
                        }
                    } elseif (file_exists($source)) {
                        $imageData = file_get_contents($source);
                    }
                } catch (\Exception $e) {
                    Log::warning("Failed to fetch primary image for talent {$talentId}, falling back to initials.");
                }
            }

            // 2. Fallback to Initials if no image data
            if (!$imageData) {
                $name = urlencode($talent->name);
                // We use a slightly different background or ensure the logo is visible
                $fallbackUrl = "https://ui-avatars.com/api/?name={$name}&background=223757&color=ffffff&size=1200&font-size=0.35&bold=true";
                try {
                    $response = Http::timeout(10)->get($fallbackUrl);
                    if ($response->successful()) {
                        $imageData = $response->body();
                    }
                } catch (\Exception $e) {
                    Log::warning("Failed to fetch initials avatar for talent {$talentId}.");
                }
            }

            // 3. Create image object
            if ($imageData) {
                $image = $manager->decode($imageData);
            } else {
                // Absolute last resort: Solid background color
                $image = $manager->createImage(1200, 630)->fill('223757');
            }

            // 4. Crop / resize to 1200x630 OG dimensions
            $image->cover(1200, 630);

            // 5. Dark overlay using drawRectangle
            $image->drawRectangle(function ($rect) {
                $rect->at(0, 0);
                $rect->size(1200, 630);
                $rect->background('rgba(0, 0, 0, 0.4)');
            });

            // 6. Hailerz logo (top-left)
            $logoPath = public_path('images/logo.webp');
            if (file_exists($logoPath)) {
                // Use decode with the path directly (v4 supports this via FilePathImageDecoder)
                $logo = $manager->decode($logoPath);
                $logo->scale(height: 80); // Increased size slightly for better visibility
                $image->insert($logo, 40, 40, 'top-left');
            }

            // 7. Encode to WebP and return raw bytes
            return $image->encodeUsingMediaType('image/webp')->toString();

        } catch (\Throwable $e) {
            /** @var int $talentId */
            $talentId = $talent->id;
            Log::error("OG Image generation failed for talent {$talentId}: " . $e->getMessage(), [
                'exception' => $e,
            ]);
            return null;
        }
    }
}
