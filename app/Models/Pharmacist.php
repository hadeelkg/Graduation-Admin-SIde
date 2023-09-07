<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\softDeletes;


class Pharmacist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'image_path',
        'bio',
        'facebook_link',
        'phone',
    ];
}
