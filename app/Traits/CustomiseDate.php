<?php

namespace App\Traits;

use Carbon\Carbon;

trait CustomiseDate

{
    public function getCreatedAtAttribute($value)
    {
        $createdAt = new Carbon($value);
        return $createdAt->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {
        $updatedAt = new Carbon($value);
        return $updatedAt->diffForHumans();
    }
    // date('Y-M-d h:i A', strtotime($value));
}
