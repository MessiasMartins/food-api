<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\OrderResourceCollection;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::with('itens')->get();
        return new OrderResourceCollection($order);
    }
}
