<?php

if (! function_exists('getModelStoredPhoto')) {
    function getModelStoredPhoto(?string $path, ?string $defaultPath = 'img/video_placeholder.jpg'): string
    {
        if ($path === null) {
            return asset($defaultPath);
        }
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        return Storage::url($path);
    }
}
