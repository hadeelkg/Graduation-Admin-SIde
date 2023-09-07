<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\softDeletes;



class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'rate',
        'client_id',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(client::class);
    }
}
