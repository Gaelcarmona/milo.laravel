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
        return $this->belongsTo(Matchs::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'championship_user', 'championship_id', 'user_id');
    }
}
