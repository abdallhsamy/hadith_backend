<?php

namespace App\Models;

use App\Traits\Models\HasTranslations;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Hadith extends Model
{
    use HasSEO, HasTranslations;

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

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->translation()->title,
            description: $this->translation()->hadeeth,
            image: asset('gradient_placeholder.png'),
        );
    }

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

    public function bookmarkedUsers(): \MongoDB\Laravel\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            User::class, null, 'bookmarked_hadith_ids', 'bookmarked_user_ids',
        );
    }

    public function dailySelectedDays(): \MongoDB\Laravel\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            DailySelectedHadith::class, null, 'hadith_ids', 'daily_selected_hadith_ids',
        );
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany|\MongoDB\Laravel\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'hadith_id');
    }


    public function parentCommentsOnly(): \Illuminate\Database\Eloquent\Relations\HasMany|\MongoDB\Laravel\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'hadith_id')->whereNull('parent_id');
    }

    public function getIsBookmarkedAttribute()
    {
        return auth()->check()
            && in_array($this->_id, auth()->user()->bookmarkedHadiths()->pluck('_id')->toArray());
    }
}
