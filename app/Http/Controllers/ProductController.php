<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductResourceCollection;


class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return new ProductResourceCollection($product);
    }

    public function store(Request $request)
    {
        //$request->validate();

        try{
            //DB::beginTransaction();
            $product = Product::create($request->all());

    //DB::commit();
            return response()->json(new ProductResource($product), 201);
        } catch (\Exception $ex) {
            response()->json($ex->getMessage(), 400);
                //DB::rollBack();
        }
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return $product;
    }

    public function destroy(Product $product)
    {
        return $product->delete();
    }
}
