<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
      
        // $products = Product::inRandomOrder()->take(6)->get();

        if(request()->categorie ){
            $products = Product::with('categories')->wherehas('categories' , function($query){
                $query->where('slug' ,request()->categorie );
            })->paginate(6);
        }else{
            $products = Product::with('categories')->paginate(6);
        }
       

        return view('products.index',compact('products'));
    }

    public function show($slug){

        $product = Product::where('slug',$slug)->firstOrFail();
        return view('products.show',compact('product'));
    }

    public function search(){
     $q =request()->input('q');
     $products = Product::where('title','like',"%$q%")
                ->orWhere('description','like',"%$q%")
                ->paginate(6);
    return view('products.search',compact('products'));

    }
}
