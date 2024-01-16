<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductResource;
use Carbon\Carbon;

class OrderProductResource extends JsonResource
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
            'product_price' => $this->product_price,
            'quantity' => $this->quantity,
            'subtotal_price' => $this->subtotal_price,
            'product' => new ProductResource($this->product),
            'order_id' => $this->order_id,
            // 'created_at' => $this->created_at,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
