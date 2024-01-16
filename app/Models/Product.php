<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;
// use Illuminate\Database\Eloquent\softDeletes;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'image_path',
      'price',
      'discount',
      'quantity',
      'description',
      'target_sex',
      'category_id',
      'brand_id',
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(brand::class);
    }

    public function order_products(): hasMany
    {
        return $this->hasMany(order_product::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);

    }

    // public function product_image(): hasMany
    // {
    //     return $this->hasMany(product_image::class);
    // }


}
