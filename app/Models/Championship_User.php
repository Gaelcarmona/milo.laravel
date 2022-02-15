<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Championship_User extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'championship_id',
    ];
}
