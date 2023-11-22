<?php

namespace App\Traits\Models;

trait HasTranslations
{
    public function translation(string $lang = null): object
    {
        if (! property_exists($this, 'translatableValues')) {
            throw new \RuntimeException('The $translatableValues property must be defined in the class.');
        }

        if (! $lang) {
            $lang = app()->getLocale();
        }

        $translation = [];

        foreach ($this->translatableValues as $key) {
            if (array_key_exists($lang, $this->$key)) {
                $translation[$key] = $this->$key[$lang];
            } else {
                $translation[$key] = null;
            }
        }

        return (object) $translation;
    }

    //    public function translation(string|null $lang = null)
    //    {
    //        $translatableValues = [
    //            'title',
    //            'hadeeth',
    //            'attribution',
    //            'grade',
    //            'explanation',
    //            'hints',
    //            'words_meanings',
    //            'reference',
    //        ];
    //
    //        if (! $lang) {
    //            $lang = app()->getLocale();
    //        }
    //
    //        $translation = [];
    //
    //        foreach ($translatableValues as $key) {
    //            if (array_key_exists($lang, $this->$key)) {
    //                $translation[$key] = $this->$key[$lang];
    //            } else {
    //                $translation[$key] = null;
    //            }
    //        }
    //
    //        return (object) $translation;
    //    }

}
