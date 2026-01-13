<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order_table';

    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'text',
        'money',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];
}