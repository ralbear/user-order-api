<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'title',
        'status',
        'amount'
    ];

    protected $casts = [
        'user_id' => 'integer'
    ];
}
