<?php

namespace App\Models;

class GrabbedCatHadith extends Model
{
    //    use HasTranslations;
    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
    ];
    //    protected $casts = [
    ////        'title' => 'array'
    //    ];
    //
    //
    //    public function hadiths()
    //    {
    //        return $this->belongsToMany(
    //            Hadith::class, null, 'hadith_ids', 'group_ids'
    //        );
    //    }
}
