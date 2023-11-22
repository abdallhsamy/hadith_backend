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

    public function hadiths(): \MongoDB\Laravel\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Hadith::class, null, 'hadith_ids', 'group_ids'
        );
    }

    public function parentCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function childCategories(): \Illuminate\Database\Eloquent\Relations\HasMany|\MongoDB\Laravel\Relations\HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }
}
