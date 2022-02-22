<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'image_id',
    ];


    public function results()
    {
        return $this->belongsTo(Result::class);
    }
}
