<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Products extends Model
{
    use HasFactory;

    protected $table = 'order_products';

    public function order()
    {
        return $this->hasOne(Order::class,'id', 'order_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class,'id', 'product_id');
    }
}
