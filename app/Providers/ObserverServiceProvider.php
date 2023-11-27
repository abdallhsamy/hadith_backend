<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        \App\Models\ContactMessage::observe(\App\Observers\ContactMessageObserver::class);
    }
}
