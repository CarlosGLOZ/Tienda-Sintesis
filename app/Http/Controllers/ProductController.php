<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            $product->image = asset('storage/images/products/prod_'.$product->id.'.png');
        }

        return $products;
    }

    /**
     * Display the individual product view along with the info of one given product
     */
    public function find($productId)
    {
        $product = Product::with(['reviews' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'reviews.author'])->find($productId);

        return view('product.view', compact(['product']));
    }

    /**
     * Display the view for creating a product
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Return the products in a JSON format in order to be used to form a table
     */
    public function table(Request $request){
        $filtro=$request->except('_token');

        $products=Product::get();


        return $products;
    }

    /**
     * Destroy an instance of the product and delete its image
     */
    public function destroy(Request $request){

        $id = $request->input('id');

        $imagePath = storage_path('app\public\images\products\prod_'. $id.'.png');
        
        if (file_exists($imagePath)) {
            unlink($imagePath);
        } 
        
        try {
            Product::find($id)->delete();
            $return = ['OK'];
        } catch (\Throwable $th) {
            $return = ['NOT - OK ', 'error' => $th];
        }

        return $return;
    }

    /**
     * Store a new instance of a product in the database and save the given image
     */
    public function store(Request $request){

        // Validate that user is logged in and an admin
        if (!Auth::check() || auth()->user()->admin != 1) {
            return ['status' => 'NOT OK', 'message' => 'Unauthorized access', 'icon' => 'error'];
        }

        $product = $request->except('_token', 'img');
        $filetype = explode('/', $_FILES['img']['type'])[1];

        // Use Validator class to avoid automatic response by laravel
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric|min:0',
                'img' => 'required|file|image'
            ]
        );

        if ($validation->stopOnFirstFailure()->fails()) {
            return ['status' => 'NOT OK', 'message' => $validation->errors()->first(), 'icon' => 'error'];
        }


        if ($filetype != 'png') {
            return ['status' => 'NOT OK', 'message' => 'Invalid File Type', 'icon' => 'error'];
        }

        try {
            $id = Product::insertGetId($product);

            $request->file('img')->move(public_path('storage/images/products'), 'prod_'.$id.'.png');
            
            return ['status' => 'OK', 'message' => 'Product created successfully', 'icon' => 'success'];
        } catch (\Throwable $th) {
            return ['status' => 'OK', 'message' => $th, 'icon' => 'error'];
        }
    }

    /**
     * Show the edit form for a product
     */
    public function edit(Request $request)
    {
        // Validate that user is logged in and an admin
        if (!Auth::check() || auth()->user()->admin != 1) {
            return ['status' => 'NOT OK', 'message' => 'Unauthorized access', 'icon' => 'error'];
        }

        $id = $request->input('id');

        $product = Product::find($id);

        return view('product.create', compact(['product']));
    }

    public function editarProducto(Request $re){
        $id = $re->input('id');


    
    
            $restaurante=Product::find($id);
        

            return response()->json($restaurante);
        

    }

}
