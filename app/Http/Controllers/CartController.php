<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('carts.index');
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
       // verifier si le produit a déja été rajouter dans le panier 
        $duplicata = Cart::search(function ($cartItem, $rowId) use($request) {
            return $cartItem->id == $request->product_id;
        });
        // si l'id existe dans le panier alors je retourne un message flas()
        if($duplicata->isNotEmpty()){
        return redirect()->route('products.index')->with('success','Le produit à déja  été rajouter a votre panier');
        } 
          
         // au cas contraire je recupere id du produit
        $product = Product::find($request->product_id);
         // Recuperations des informations pour le mettre dans mon panier
         Cart::add($product->id,$product->title, 1, $product->price)->associate('App\Product');

        return redirect()->route('products.index')->with('success','Le produit à bien été ajouter a votre panier');
        
         

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
    public function destroy($rowId)
    {
        Cart::remove($rowId);

        return back()->with('success','le produit a bien été supprimer.');
    }
}
