<?php

use Illuminate\Support\Facades\URL;

/**
 * Turn a stored menu path or site-relative URL into a full URL (works in subdirectories).
 */
function public_url(?string $url): string
{
    $url = trim((string) $url);

    if ($url === '' || $url === '#') {
        return '#';
    }

    if (preg_match('#^https?://#i', $url) || str_starts_with($url, '//')) {
        return $url;
    }

    return URL::to('/'.ltrim($url, '/'));
}

/**
 * Rewrite root-absolute src/href in HTML (e.g. /frontend/..., /storage/...) for subdirectory installs.
 */
function rewrite_html_root_paths(?string $html): ?string
{
    if ($html === null || $html === '') {
        return $html;
    }

    if (! str_contains($html, '="/') && ! str_contains($html, "='/")) {
        return $html;
    }

    return preg_replace_callback(
        '#(\s(?:src|href|data-src)=["\'])(/[^"\']*)#i',
        static function (array $matches): string {
            $path = $matches[2];
            if (str_starts_with($path, '//')) {
                return $matches[0];
            }

            return $matches[1].URL::to($path);
        },
        $html
    );
}
