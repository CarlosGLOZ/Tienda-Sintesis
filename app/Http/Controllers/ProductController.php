<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

public function listar_crud_pro(Request $request){
    $filtro=$request->except('_token');

    $consulta=Product::get();


    return response()->json($consulta);
}


public function eliminarProducto(Request $request){

    $id = $request->input('id');

    $imagePath = public_path()."/storage/productos/". $id.'.jpg';
      
    if (file_exists($imagePath)) {
        unlink($imagePath);
    } 
    Product::find($id)->delete();

    $resultado = "OK";
    return response()->json($resultado);
}



public function editarProducto(Request $re){
    $id = $re->input('id');


   
 
        $restaurante=Product::find($id);
       

        return response()->json($restaurante);
    

}


public function crearProducto(Request $request){

    $producto = $request->except('_token');
    $tipo_archivo = $_FILES['img']['type'];

    if (!$producto['id']) {
    
        if ( empty( $producto['nombre'])  || empty($producto['descripcion'])   || empty($producto['precio']) || empty($producto['img'])  ) {
            
            $resultado = "vacio";
        
        }
         elseif ( !(is_numeric($producto['precio'])) ||  ($producto['precio']<1) || ($tipo_archivo!="image/jpeg" && $tipo_archivo!="image/jpg" && $tipo_archivo!="image/png" && $tipo_archivo!="image/gif" && $tipo_archivo!="image/webp") ) {
            $resultado = "mal_formato";
        } 
        else {
            $id = Db::table('products')->insertGetId(['name'=>$producto['nombre'],'description'=>$producto['descripcion'],'price'=>$producto['precio']]);
       
            $request->file('img')->storeAs('productos',$id.'.jpg','public');
        
            $resultado = "OK";
        }

    } else {
        
        if  (!empty($producto['img']) && ($tipo_archivo!="image/jpeg" && $tipo_archivo!="image/jpg" && $tipo_archivo!="image/png" && $tipo_archivo!="image/gif" && $tipo_archivo!="image/webp")) {
            $resultado = "mal_formato";
        } else {
            if (!empty($producto['img'])){

                $imagePath = public_path()."/storage/productos/". $producto['id'].'.jpg';
        
                
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                } 
        
              
                $path = $request->file('img')->storeAs('productos',  $producto['id'].'.jpg', 'public');

             
            } 

            if ( empty( $producto['nombre'])  || empty($producto['descripcion'])   || empty($producto['precio']) ) {
            
                $resultado = "vacio";
            
            } else if (!(is_numeric($producto['precio'])) || $producto['precio']<1) {
                $resultado = "mal_formato";
            } else {
                DB::table('products')->where('id','=',$producto['id'])->update(['name'=>$producto['nombre'],'description'=>$producto['descripcion'],'price'=>$producto['precio']]);
                $resultado="actualizar";
            }
        }
    }

    return response()->json($resultado);
}


    public function find($productId)
    {
        $product = Product::with(['reviews' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'reviews.author'])->find($productId);

        return view('product.view', compact(['product']));
    }
}
