<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $name_filter = $request->input('name_filter', '');
        $order_column_filter = $request->input('order_column_filter', 'name');
        $order_direction_filter = $request->input('order_direction_filter', 'ASC');

        $products = Product::where('name', 'LIKE', '%'.$name_filter.'%')->orderBy($order_column_filter, $order_direction_filter)->paginate(20);

        foreach ($products as $product) {
            $product->image = asset('../resources/images/products/prod_'.$product->id.'.png');
        }

        return $products;
    }

    public function find($productId)
    {
        $product = Product::with(['reviews' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'reviews.author'])->find($productId);

        return view('product.view', compact(['product']));
    }
}
