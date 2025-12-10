<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'address', 'items',
        'total_amount', 'payment_id', 'payment_status'
    ];
}
