<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\OrderProductResource;

class OrderResource extends JsonResource
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
            'total_price' => $this->total_price,
            'status' => $this->status,
            'client' => new ClientResource($this->client),
            // لازم كوليكشن لان نوعية العلاقة hasMany
            'order_product' => OrderProductResource::collection($this->order_products),
            'created_at' => $this->created_at,
        ];
    }
}
