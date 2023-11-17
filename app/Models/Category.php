<?php

namespace App\Models;

use App\Traits\Models\HasTranslations;

class Category extends Model
{
    use HasTranslations;
    protected $fillable = [
        'id',
        'title',
        'hadeeths_count',
        'parent_id',
    ];

    protected $translatableValues = [
        'title',
    ];

    protected $casts = [
//        'title' => 'array'
    ];


    public function hadiths()
    {
        return $this->belongsToMany(
            Hadith::class, null, 'hadith_ids', 'group_ids'
        );
    }
}
