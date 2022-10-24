<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use Carbon\Carbon;
use http\Client\Response;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\OrderResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
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

//            $produtos = $request->products;

//            $prods = [];
//            foreach ($produtos as $produto) {
//                $prod_aux = Product::find($produto->id);
//                if(!$prod_aux){
//                    throw new \Exception("Produto {$produto->id} Não existe!");
//                }
//                $prods[] = $prod_aux;
//            }

            $order = new Order();
            $order->client_id = $client->id;
            $order->date = Carbon::now();
            $order->delivery_address = $request->delivery_address;
            $order->status = Order::STATUS_AGUARDANDO_PAGAMENTO;

            $order->save();

//            foreach ($prods as $prod) {
//                $order->products()->save($prod);
//            }

            DB::commit();

            return response()->json(['status' => 'success', 'order' => $order], 201);
        }catch (\Exception $ex){
            DB::rollBack();
            return response()->json(['status' => 'error', 'erro' => $ex->getMessage()], 401);
        }
    }
}
