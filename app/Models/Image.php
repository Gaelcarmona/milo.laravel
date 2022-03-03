<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'image_id', 'id');
    }

    public function matchs()
    {
        return $this->hasMany(Matchs::class, 'image_id', 'id');
    }

    public function decks()
    {
        return $this->hasMany(Deck::class, 'image_id', 'id');
    }

    public function championships()
    {
        return $this->hasMany(Championship::class, 'image_id', 'id');
    }


}
