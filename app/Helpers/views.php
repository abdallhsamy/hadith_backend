<?php

if (! function_exists('getHtmlDirection')) {
    function getHtmlDirection(): string
    {
        $rtlLanguages = [
            'ar', // Arabic
            'ur', // Urdu
            'fa', // Persian
            //            'he', Hebrew is not in list
        ];
        if (in_array(app()->getLocale(), $rtlLanguages, true)) {
            return 'rtl';
        }

        return 'ltr';
    }
}

if (! function_exists('isHtmlDirection')) {
    function isHtmlDirection(string $dir = null): bool
    {
        return getHtmlDirection() === $dir;
    }
}
