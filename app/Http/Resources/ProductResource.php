<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
// use App\Http\Resources\ProductImageResource;


class ProductResource extends JsonResource
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
            'image_path' => $this->image_path,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'category' => new CategoryResource($this->category),
            'brand' => new BrandResource($this->brand),
            'created_at' => $this->created_at,
        ];
    }
}
