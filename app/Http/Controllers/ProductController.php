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
}
