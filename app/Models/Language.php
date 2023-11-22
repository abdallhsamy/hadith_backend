<?php

namespace App\Models;

class Language extends Model
{
    protected $fillable = [
        'code',
        'native',
    ];

    public function categories(): \MongoDB\Laravel\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Category::class, null, 'language_ids','category_ids'
        );
    }

    public function hadiths(): \MongoDB\Laravel\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Category::class, null, 'language_ids','hadith_ids'
        );
    }
}
