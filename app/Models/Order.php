<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->hasOne(Client::class,'id', 'client_id');
    }

    public function itens()
    {
        return $this->hasMany(Order_Pruducts::class);
    }
}
