<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_AGUARDANDO_PAGAMENTO = 1;
    const STATUS_PAGO = 2;
    const STATUS_PREPARANDO_ENVIO = 3;
    const STATUS_ENVIADO = 4;
    const STATUS_ENTREGE = 5;

    protected $fillable =[

    ];

    public function client()
    {
        return $this->hasOne(Client::class,'id', 'client_id');
    }

    public function itens()
    {
        return $this->hasMany(Order_Pruducts::class);
    }
}
