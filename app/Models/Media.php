<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_path',
        'file_size',
        'file_type',
        'mediable_id',
        'mediable_type'
    ];

    /**
     * Get the parent mediable model (user, post, etc.).
     */
    public function mediable()
    {
        return $this->morphTo();
    }

    // public function getFilePathAttribute($value)
    // {
    //     return asset($value);
    // }
}
