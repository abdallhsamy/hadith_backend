<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Jobs\SendVerifyRegisteredUserEmailJob;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use MongoDB\Laravel\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'status',
        'gender',
        'avatar',
        'email_verified_at',
        'phone_verified_at',
        'password',
        'update_email',
        'email_verification_code',
    ];

    public static function getDefaultRole(): UserRole
    {
        return UserRole::USER;
    }

    public static function getDefaultStatus(): UserStatus
    {
        return UserStatus::PENDING;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sendEmailVerificationNotification(): void
    {
        $this->update(['email_verification_code' => substr(md5(now()), 3, 7)]);

        dispatch(new SendVerifyRegisteredUserEmailJob($this));

    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function avatar(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => getModelStoredPhoto($value, asset('assets/images/default-avatar.svg')),
        );
    }

    //

    //    public function (): \MongoDB\Laravel\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Relations\BelongsToMany
    //    {
    //        return $this->belongsToMany(
    //            Category::class, null, 'language_ids', 'hadith_ids'
    //        );
    //    }

    public function bookmarkedHadiths(): \MongoDB\Laravel\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Hadith::class, null, 'bookmarked_user_ids', 'bookmarked_hadith_ids',
        );
    }

    public function contactMessages(): \Illuminate\Database\Eloquent\Relations\HasMany|\MongoDB\Laravel\Relations\HasMany
    {
        return $this->hasMany(ContactMessage::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function passwordResets(): \Illuminate\Database\Eloquent\Relations\HasMany|\MongoDB\Laravel\Relations\HasMany
    {
        return $this->hasMany(PasswordReset::class, 'user_id');
    }
}
