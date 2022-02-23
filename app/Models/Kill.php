<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kill extends Model
{
    use HasFactory;

    protected $fillable = [
        'result_id',
        'user_killed_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_killed_id');
    }

    public function result()
    {
        return $this->hasOne(Result::class, 'id', 'result_id');
    }
}
