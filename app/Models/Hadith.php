<?php

namespace App\Models;

use App\Traits\Models\HasTranslations;

class Hadith extends Model
{
    use HasTranslations;

    protected $fillable = [
        'id',
        'title',
        'hadeeth',
        'attribution',
        'grade',
        'explanation',
        'hints',
        'categories',
        'translations',
        'words_meanings',
        'reference',

        'views',
    ];

    protected $casts = [
        'views' => 'integer',
    ];

    //    protected $guarded = [];

    protected array $translatableValues = [
        'title',
        'hadeeth',
        'attribution',
        'grade',
        'explanation',
        'hints',
        'words_meanings',
        'reference',
    ];

    public function categoriesRel()
    {
        return $this->belongsToMany(
            Category::class, null, 'hadith_ids', 'category_ids'
        );
    }

    public function languages(): \MongoDB\Laravel\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Language::class, null, 'hadith_ids', 'language_ids',
        );
    }
}
