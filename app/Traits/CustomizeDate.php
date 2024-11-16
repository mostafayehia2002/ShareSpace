<?php

namespace App\Traits;

use Carbon\Carbon;

trait CustomizeDate
{
    /**
     * Get the created_at attribute in a human-readable format.
     *
     * @param string $value The date value.
     * @return string
     */
    public function getCreatedAtAttribute(string $value='diffForHumans'): string
    {
        return $this->formatDate($value, 'diffForHumans');
    }

    /**
     * Get the updated_at attribute in a human-readable format.
     *
     * @param string $value The date value.
     * @return string
     */
    public function getUpdatedAtAttribute(string $value='diffForHuman'): string
    {
        return $this->formatDate($value, 'diffForHumans');
    }

    /**
     * Format date in a custom format or return relative time.
     *
     * @param string $value The date value.
     * @param string $format The format to return (default is 'Y-m-d H:i:s' or 'diffForHumans').
     * @param string|null $timezone The timezone to use (optional).
     * @return string
     */
    public function formatDate(string $value, string $format = 'Y-m-d H:i:s', string $timezone = null): string
    {
        try {
            $date = new Carbon($value);
            if ($timezone) {
                $date->setTimezone($timezone);
            }
            return $format === 'diffForHumans' ? $date->diffForHumans() : $date->format($format);
        } catch (\Exception $e) {
            return 'Invalid date';
        }
    }
}
