<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kill extends Model
{
    use HasFactory;

    protected $fillable = [
        'result_id',
        'player_killed_id',
    ];
}
