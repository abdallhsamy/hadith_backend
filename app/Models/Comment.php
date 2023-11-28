<?php

namespace App\Models;

use App\Models\Scopes\VerifiedScope;
use RalphJSmit\Helpers\Laravel\Concerns\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'verified_at',
        'verified_by_user_id',
        'parent_id',
        'hadith_id',
        'hide_author'
    ];

    protected $casts = [
        'verified_at' => 'datetime'
    ];

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hadith(): \Illuminate\Database\Eloquent\Relations\BelongsTo|\MongoDB\Laravel\Relations\BelongsTo
    {
        return $this->belongsTo(Hadith::class, 'hadith_id');
    }

    public function childComments()
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function parentComment()
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function scopeVerified($query)
    {
        return $query->whereNotNull('verified_at');
    }

    public function scopeOwned($query)
    {
        if (auth()->guest()) {
            return $query;
        }

        return $query->where('user_id' , auth()->id());
    }

    public function scopeVerifiedOrOwned($query)
    {
        $query->whereNotNull('verified_at');

        if (auth()->guest()) {
            return $query;
        }

        return $query->orWhere('user_id' , auth()->id());
    }

//    public static function booted()
//    {
//        static::addGlobalScope(new VerifiedScope());
//    }

}
