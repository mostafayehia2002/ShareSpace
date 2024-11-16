<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type'
    ];

    public function media()
    {
        return $this->morphOne(Media::class, 'mediable');
    }

    public function content()
    {
        return $this->hasOne(Content::class);
    }
}
