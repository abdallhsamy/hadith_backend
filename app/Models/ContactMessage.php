<?php

namespace App\Models;

class ContactMessage extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'subject',
        'message',
        'attachments',
        'seen_at',
        'replied_at',
        'reply',
        'replied_by_user_id'
    ];

    protected $casts = [
        'seen_at' => 'datetime',
        'replied_at' => 'datetime',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
