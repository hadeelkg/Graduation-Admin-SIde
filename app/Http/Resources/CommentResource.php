<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Resources\ClientResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'content' => $this->content,
            'title' => $this->title,
            'client_name' => $this->client_name,
            // 'rate' => $this->rate,
            // 'client' => new ClientResource($this->client),
            'created_at' => $this->created_at,
        ];
    }
}
