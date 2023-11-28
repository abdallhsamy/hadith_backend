<?php

namespace App\Models;

use Carbon\Carbon;

class DailySelectedHadith extends Model
{
    protected $fillable = [
        //        'hadith_id',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function hadiths(): \MongoDB\Laravel\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Hadith::class, null, 'daily_selected_hadith_ids', 'hadith_ids'
        );
    }

    public static function getHadiths(?int $subDays = 0, ?int $take = 4)
    {
        $date = Carbon::today()->subDays($subDays);

        $instance = self::query()->whereDate('date', $date)->first();

        if (! $instance) {
            $existingHadithIds = array_unique(array_merge(...self::query()->whereDate('date', '>=', Carbon::today()->subDays(3))->pluck('hadith_ids')->toArray()));

            $selectedHadiths = Hadith::query()
                ->whereNotIn('_id', $existingHadithIds)
                ->orderBy('views', 'asc')->take($take)->get();

            $date = Carbon::today()->format('Y-m-d');

            $instance = self::create(compact('date'));

            $instance->hadiths()->attach($selectedHadiths);
        }

        return $instance->hadiths;
    }
}
