<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matchs extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'championship_id',
        'image_id',
    ];

    public function championship()
    {
        return $this->hasOne(Championship::class, 'id', 'championship_id');
    }

    public function results()
    {
        return $this->belongsTo(Result::class);
    }

}
