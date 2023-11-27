<?php

namespace App\Models;

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
}
