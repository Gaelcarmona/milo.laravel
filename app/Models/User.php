<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pseudo',
        'email',
        'password',
        'image_id',
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


    public function results()
    {
        return $this->belongsTo(Result::class);
    }

    public function matchs()
    {
        return $this->belongsTo(Matchs::class);
    }

    public function championshipUser()
    {
        return $this->belongsTo(Championship_User::class);
    }

    public function associateUsers()
    {
        return $this->belongsTo(Associate_User::class);
    }

    public function kills()
    {
        return $this->belongsTo(Kill::class);
    }

    public function decks()
    {
        return $this->belongsTo(Deck::class);
    }

    public function championships()
    {
        return $this->belongsToMany(Championship::class, 'championship_user', 'user_id', 'championship_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'associate_user', 'user_id', 'creator_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'associate_user', 'creator_id', 'user_id');
    }

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }


}
