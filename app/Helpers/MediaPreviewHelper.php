<?php

namespace App\Helpers;

class MediaPreviewHelper
{
    public static function getPreviewHtml(?string $url): string
    {
        if (empty($url) || ! filter_var($url, FILTER_VALIDATE_URL)) {
            return '';
        }

        // Clean URL
        $url = trim($url);

        // Check if YouTube
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/||user/[^/]+/||watch\?v=)|youtu\.be/)([^"&?/\s]{11})%i', $url, $match)) {
            $videoId = $match[1];

            return <<<HTML
                <div class="mt-2">
                    <iframe class="w-full aspect-video rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 max-w-md"
                            src="https://www.youtube.com/embed/{$videoId}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            HTML;
        }

        // Check if Vimeo
        if (preg_match('%vimeo\.com/(?:channels/(?:\w+\/)?|groups/([^/]*)/videos/|album/(\d+)/video/|video/|)(\d+)(?:$|\/|\?)%i', $url, $match)) {
            $videoId = $match[3];

            return <<<HTML
                <div class="mt-2">
                    <iframe class="w-full aspect-video rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 max-w-md"
                            src="https://player.vimeo.com/video/{$videoId}"
                            frameborder="0"
                            allow="autoplay; fullscreen; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            HTML;
        }

        // Check if PDF
        if (str_ends_with(strtolower(parse_url($url, PHP_URL_PATH) ?? ''), '.pdf')) {
            return <<<HTML
                <div class="mt-2 flex items-center gap-2 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 max-w-md">
                    <svg class="w-8 h-8 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">PDF Document</p>
                        <a href="{$url}" target="_blank" class="text-xs text-primary-600 dark:text-primary-400 hover:underline">View in new tab</a>
                    </div>
                </div>
            HTML;
        }

        // Default: Treat as image but add error fallback to a clean file/link icon card
        $escapedUrl = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');

        return <<<HTML
            <div class="mt-2 relative">
                <img src="{$escapedUrl}"
                     alt="Preview"
                     class="max-h-48 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 object-contain"
                     style="display: block;"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                <div class="flex items-center gap-2 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 max-w-md" style="display: none;">
                    <svg class="w-8 h-8 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">External Asset</p>
                        <a href="{$escapedUrl}" target="_blank" class="text-xs text-primary-600 dark:text-primary-400 hover:underline">{$escapedUrl}</a>
                    </div>
                </div>
            </div>
        HTML;
    }
}
