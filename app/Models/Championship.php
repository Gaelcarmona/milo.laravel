<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Championship extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'image_id',
    ];

    public function matchs()
    {
        return $this->hasMany(Matchs::class, 'championship_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'championship_user', 'championship_id', 'user_id');
    }

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
