<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\softDeletes;



class product_image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'product_id'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(product::class);
    }
}
