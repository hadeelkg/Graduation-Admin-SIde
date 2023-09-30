<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'role' => $this->role,
            'image_path' => $this->image_path,
            'bio' => $this->bio,
            'facebook_link' => $this->facebook_link,
            'phone' => $this->phone,
            'created_at' => $this->created_at,
        ];
    }
}
