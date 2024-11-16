<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'likable_type',
        'likable_id',

    ];
    public function likable()
    {
        return $this->morphTo();
    }
}
