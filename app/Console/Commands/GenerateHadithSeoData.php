<?php

namespace App\Console\Commands;

use App\Models\Hadith;
use Illuminate\Console\Command;

class GenerateHadithSeoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-hadith-seo-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Meta data for hadiths';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hadiths = Hadith::all();

        foreach ($hadiths as $hadith) {

        }
    }
}
