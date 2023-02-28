<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $product = Product::find($productId);

        return $product;
    }

    public function cart(){
        return view('cart');
       
    }

    public function pagar($correo, $precio){
        // return $correo;
        // return $precio;
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('services.paypal.client_id'), // ClientID
                config('services.paypal.secret') // ClientSecret
            )
        );


        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');


        $amount = new \PayPal\Api\Amount();
        //precio a pagar
        $amount->setTotal($precio);
        $amount->setCurrency('EUR');


        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);
        //le envioa la pagina informacion del id
        //si se cancela lo llevo a la pagina que quiero
        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls
        ->setReturnUrl(url("comprado/".$correo))  //Ruta 'OK'
        ->setCancelUrl(url("/cesta"));        //Ruta 'Cancel'


        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
        try {
            $payment->create($apiContext);
            //me redirige a la pagina de paypal
            return redirect()->away( $payment->getApprovalLink());


        }catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }
    }

    public function comprado($correo, Request $request){
        // return $correo;
        dd($request);
    }
}
