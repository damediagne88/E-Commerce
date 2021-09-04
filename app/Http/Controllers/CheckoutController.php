<?php

namespace App\Http\Controllers;

use DateTime;
use App\Order;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Cette fonction nous permets d'empecher au utilisateur d'aller sur la page paiement 
         * si leur panier est vide 
         * */ 
        if(Cart::count() <=0){
         return redirect()->route('products.index');
        }
        

       // la clé secrete de api stripe
        Stripe::setApiKey('sk_test_VePHdqKTYQjKNInc7u56JBrQ');
       
        // cette fonction nous permets d'avoir une intention de payement qu'on va envoie a notre front
        $intent = PaymentIntent::create([
            'amount' => round(Cart::total()),
            'currency' => 'usd',
          ]);

          // recuperation de notre clientsecret via un tableau 

          $clientSecret = arr::get($intent,'client_secret');

        return view('checkout.index',compact('clientSecret'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $data = $request->json()->all();
        
        $order = new Order();

        $order->payment_intent_id = $data['paymentIntent']['id'];
        $order->amount = $data['paymentIntent']['amount'];
        $order->payment_create_at = (new DateTime())
                                    ->setTimestamp($data['paymentIntent']['created'])
                                    ->format('Y-m-d H:i:s');

        // recuperer les produits 

        $products = [];
        $i = 0;

        foreach(Cart::content() as $product){
        $products['product_'.$i][] = $product->model->title;
        $products['product_'.$i][] = $product->model->price;
        $products['product_'.$i][] = $product->qty;
        $i++;

        }
        $order->products = serialize($products);

        $order->user_id = 15;

        $order->save();

        // verifiaction du paymentIntent 

        if($data['paymentIntent']['status'] == 'succeeded'){
            Cart::destroy();
            Session::flash('success','Votre commande à été traiter avec success');
            return response()->json(['success','Payment Intent Succeeded']);
        }else{
            return response()->json(['error','Payment Intent not  Succeeded']);
        }

        //return $data['paymentIntent'];
       
    }

    public function thank(){

        if (Session::has('success')) {
           return view('checkout.thank');
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
