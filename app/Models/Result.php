<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'deck_id',
        'match_id',
        'place',
        'score',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function deck()
    {
        return $this->hasOne(Deck::class, 'id', 'deck_id');
    }

    public function match()
    {
        return $this->hasOne(Matchs::class, 'id', 'match_id');
    }

    public function kills()
    {
        return $this->belongsTo(Kill::class);
    }
}
