<?php

namespace App\Http\Resources;

use App\Traits\CustomizeDate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileInfoResource extends JsonResource
{
    use CustomizeDate;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' > $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'user_type' => $this->user_type,
            'last_active_at' => $this->formatDate($this->last_active_at, 'diffForHumans'),
            'created_at' => $this->formatDate($this->created_at, 'diffForHumans'),
            'updated_at' => $this->formatDate($this->updated_at, 'diffForHumans'),
            'file_path' => $this->file_path,
        ];
    }
}
