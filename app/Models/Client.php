<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\softDeletes;



class Client extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'email',
        'password',
        'gender',
        'phone',
        'address',
        'city_id',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(city::class);
    }
}
