<?php

namespace App\Models;

use App\Traits\Models\HasTranslations;

class Hadith extends Model
{
    use HasTranslations;

    //    protected $fillable =[
    //        'id',
    //        'title',
    //        'hadeeth',
    //        'attribution',
    //        'grade',
    //        'explanation',
    //        'hints',
    //        'categories',
    //        'translations',
    //        'words_meanings',
    //        'reference',
    //    ];

    protected $guarded = [];

    protected $translatableValues = [
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
            Category::class, null, 'category_ids', 'group_ids'
        );
    }
}
