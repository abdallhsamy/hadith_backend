<?php

namespace App\Views\Composers;

use App\Models\Language;
use Illuminate\View\View;

class LanguageComposer
{
    public function compose(View $view)
    {

        try {
            $availableLanguages = Language::all();
        } catch (\Exception $e) {
            $availableLanguages = [];
        }

        $view->with(compact('availableLanguages'));
    }
}
