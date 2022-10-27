<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order_Products;
use App\Models\Product;
use Carbon\Carbon;
use http\Client\Response;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\OrderResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class  OrderController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $order = Order::with('itens')->get();
        return new OrderResourceCollection($order);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $client = Client::findOrFail($request->client_id);

            $produtos = $request->products;

            $order = new Order();
            $order->client_id = $client->id;
            $order->date = Carbon::now();
            $order->delivery_address = $request->delivery_address;
            $order->status = Order::STATUS_AGUARDANDO_PAGAMENTO;

            $order->save();

            foreach ($produtos as $produto) {
                $prod= Product::find($produto['id']);
                if(!$prod){
                    throw new \Exception("Produto {$produto['id']} Não existe!");
                }

                Order_Products::create([
                    'order_id' => $order->id,
                    'product_id' => $prod->id,
                    'amount' => $produto['quant']
                ]);
            }

            DB::commit();

            return new OrderResource($order);
        }catch (\Exception $ex){
            DB::rollBack();
            return response()->json(['status' => 'error', 'erro' => $ex->getMessage()], 401);
        }
    }
}
