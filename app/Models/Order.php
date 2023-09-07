<?php

namespace App\Models;

// use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\softDeletes;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'status',
        'client_id'
    ];
    protected $cascadeDeletes = ['order_product'];


    public function order_products(): hasMany
    {
        return $this->hasMany(order_product::class);
    }

    public function client(): BelongsTo
    {
        return $this->BelongsTo(client::class);
    }
}
