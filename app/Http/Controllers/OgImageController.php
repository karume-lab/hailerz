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

        $cacheKey = "talent_og_image_bytes_{$talent->id}";

        // Cache the raw webp bytes (not the Response object)
        $imageBytes = Cache::remember($cacheKey, 86400, function () use ($talent) {
            return $this->generateOgImage($talent);
        });

        if (!$imageBytes) {
            // Generation failed — redirect to ui-avatars fallback
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
            // Lazy-load Intervention Image classes to avoid errors when GD is absent
            $managerClass = \Intervention\Image\ImageManager::class;
            $driverClass  = \Intervention\Image\Drivers\Gd\Driver::class;

            $manager = $managerClass::usingDriver($driverClass);

            // 1. Determine the source image
            $source = $talent->primary_image_url
                ?: $talent->getFirstMediaUrl('primary_image', 'optimized');

            if (!$source) {
                // Build initials image via ui-avatars and download it
                $name   = urlencode($talent->name);
                $source = "https://ui-avatars.com/api/?name={$name}&background=223757&color=ffffff&size=1200&font-size=0.35&bold=true";
            }

            // Fetch the image data (supports both URLs and local paths)
            if (filter_var($source, FILTER_VALIDATE_URL)) {
                $response = Http::timeout(15)->get($source);
                if (!$response->successful()) {
                    throw new \RuntimeException("Failed to fetch image: HTTP {$response->status()}");
                }
                $imageData = $response->body();
            } else {
                $imageData = file_get_contents($source);
            }

            $image = $manager->decode($imageData);

            // 2. Crop / resize to 1200x630 OG dimensions
            $image->cover(1200, 630);

            // 3. Dark overlay using drawRectangle (fill() doesn't support rgba in v4)
            $image->drawRectangle(function ($rect) {
                $rect->at(0, 0);
                $rect->size(1200, 630);
                $rect->background('rgba(0, 0, 0, 0.45)');
            });

            // 4. Hailerz logo (top-left)
            $logoPath = public_path('images/logo.webp');
            if (file_exists($logoPath)) {
                $logo = $manager->decode($logoPath);
                $logo->scale(height: 60);
                $image->insert($logo, 40, 40, 'top-left');
            }

            // 5. Encode to WebP and return raw bytes
            return $image->encodeUsingMediaType('image/webp')->toString();

        } catch (\Throwable $e) {
            Log::error("OG Image generation failed for talent {$talent->id}: " . $e->getMessage(), [
                'exception' => $e,
            ]);
            return null;
        }
    }
}
