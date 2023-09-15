<?php

namespace App\Models;

use App\Notifications\CustomPasswordReset;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
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
        'password',
        'profile',
        'role',
        'percent',
        'gem',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPasswordReset($token));
    }

    public function book(){
        return $this->hasMany(Book::class);
    }
    public function chapter(){
        return $this->hasMany(Chapter::class);
    }
    public function order(){
        return $this->hasMany(Order::class);
    }
    public function review(){
        return $this->hasMany(Review::class);
    }
    public function bookmark(){
        return $this->hasMany(Bookmark::class);
    }
}
