<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate Sitemap';

    public function handle(): void
    {
        set_time_limit(-1);

        $url = config('app.url');

        SitemapGenerator::create($url)
            ->getSitemap()
            ->writeToFile('public/sitemap.xml');
    }
}
