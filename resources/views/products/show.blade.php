@extends('layouts.master')

@section('content')

<div class="col-md-12">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">World</strong>
              <h6 class="mb-0">
                <a class="text-dark" href="#">{{$product->title}}</a>
              </h6>
              <div class="mb-1 text-muted">{{ $product->created_at }}</div>
              <p class="card-text mb-auto">{{ $product->description}}</p>
              <strong class="card-text mb-auto">{{ $product->getPrice()}} </strong>

              <form action="{{ route('carts.store') }}" method="post">

                @csrf
                 <input type="hidden"  name="id"  value="{{ $product->id}}">
                 <input type="hidden"  name="title"  value="{{$product->title}}">
                 <input type="hidden"  name="price"  value="{{$product->price}}">
                 <button type="submit" class="btn btn-dark">Ajouter au panier</button>

               </form>
              <!--<a href="{{ route('products.show',$product->slug)}}" class="btn btn-primary">Voir l'article</a> -->
            </div>
            <img src="{{$product->image}}">
          </div>
        </div>

@endsection