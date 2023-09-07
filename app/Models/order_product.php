<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\softDeletes;



class order_product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_price',
        'quantity',
        'subtotal_price',
        'product_id',
        'order_id'
    ];

    public function order(): BelongsTo 
    {
        return $this->belongsTo(orders::class);
    }

    public function product(): BelongsTo 
    {
        return $this->belongsTo(product::class);
    } 
}
