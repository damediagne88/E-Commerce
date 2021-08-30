@extends('layouts.master')

@section('content')

@foreach($products as $product)
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">World</strong>
              <h6 class="mb-0">
                <a class="text-dark" href="#">{{$product->title}}</a>
              </h6>
              <div class="mb-1 text-muted">{{ $product->created_at }}</div>
              <p class="card-text mb-auto">{{ $product->subtitle}}</p>
              <strong class="card-text mb-auto">{{ $product->getPrice()}} </strong>
              <a href="{{ route('products.show',$product->slug)}}" class="btn btn-primary">Voir l'article</a>
            </div>
            <img src="{{$product->image}}">
          </div>
        </div>
@endforeach

@endsection

