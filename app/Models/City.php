<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
// use Illuminate\Database\Eloquent\softDeletes;

 

class City extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];

    public function clients(): HasMany  
    {
        return $this->hasMany(client::class);
    }
}


