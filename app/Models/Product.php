<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'quantity',
        'image',
    ];

    // A product can appear in many order items.
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
