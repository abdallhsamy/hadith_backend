<?php

namespace App\Providers;

use App\Views\Composers\LanguageComposer;
use Illuminate\Support\ServiceProvider;

class SharedDataServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer(['*'], LanguageComposer::class);
    }
}
