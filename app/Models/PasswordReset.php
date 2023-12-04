<?php

namespace App\Models;


use App\Jobs\SendForgetPasswordEmailJob;

class PasswordReset extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'token',
        'ip',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($passwordReset) {
            $passwordReset->token = substr(md5(now()), 3, 13);
            $passwordReset->email = User::firstWhere('_id', $passwordReset->user_id)?->email;
            $passwordReset->ip = request()?->ip();
        });

        static::created(function ($passwordReset) {
            dispatch(new SendForgetPasswordEmailJob($passwordReset));
        });
    }

//    protected static function booted() {
//        parent::booted();
//
//        static::creating(function ($passwordReset) {
//
//        });
//    }
}
