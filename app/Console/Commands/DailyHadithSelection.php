<?php

namespace App\Console\Commands;

use App\Models\DailySelectedHadith;
use Illuminate\Console\Command;

class DailyHadithSelection extends Command
{
    protected $signature = 'app:daily-hadith-selection';

    protected $description = 'Select four hadiths based on views for today';

    public function handle(): void
    {
        DailySelectedHadith::getHadiths();
    }
}
