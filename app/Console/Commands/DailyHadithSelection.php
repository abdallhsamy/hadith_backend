<?php

namespace App\Console\Commands;

use App\Models\DailySelectedHadith;
use App\Models\Hadith;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DailyHadithSelection extends Command
{
    protected $signature = 'app:daily-hadith-selection';

    protected $description = 'Select four hadiths based on views for today';

    public function handle(): void
    {
        $selectedHadiths = Hadith::orderBy('views', 'asc')->take(4)->get();

        $date = Carbon::today()->format('Y-m-d');
        if (! DailySelectedHadith::whereDate('date', $date)->first()) {
            $day = DailySelectedHadith::create(compact('date'));

            $day->hadiths()->attach($selectedHadiths);
        }

    }
}
