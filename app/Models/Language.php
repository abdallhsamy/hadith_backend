<?php

namespace App\Models;

class Language extends Model
{
    protected $fillable = [
        'code',
        'native',
    ];

    public function categories()
    {
        return $this->belongsToMany(
            Category::class, null, 'language_ids','category_ids'
        );
    }
}
