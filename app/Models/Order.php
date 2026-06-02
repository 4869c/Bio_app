<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'total',
        'payment_status',
        'order_status',
    ];

    // An order belongs to a user (client).
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // An order has many items.
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
