<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function store(ProductRequest $request )
    {
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->category_id = Category::inRandomOrder()->first()->id;
        $product->supplier_id = Supplier::inRandomOrder()->first()->id;
        $product->save();
        return new ProductResource($product);
    }
}