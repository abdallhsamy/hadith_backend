<?php

namespace App\Models;

class Category extends Model
{
    protected $fillable = [
        'id',
        'title',
        'hadeeths_count',
        'parent_id',
    ];

    protected $casts = [
//        'title' => 'array'
    ];
}
