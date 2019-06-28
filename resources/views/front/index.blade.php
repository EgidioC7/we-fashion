@extends('layouts.master')

@section('content')

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-4 col-sm-8">
                        <div class="product-grid7">
                            <div class="product-image7">
                                @if($product->image_url)
                                    <a href="{{ url('product', $product->id)}}"><img class="img-thumbnail"
                                                                                     alt="{{$product->title}}"
                                                                                     src="{{ asset('/images/'.$product->image_url)}}"/></a>
                                @endif
                                <ul class="social">
                                    <li><a href="{{ url('product', $product->id)}}" class="fa fa-search"></a></li>
                                </ul>
                                @if($product->status_product === 'sold')
                                    <span class="product-new-label">{{$product->status_product}}</span>
                                @endif
                            </div>
                            <div class="product-content">
                                <h3 class="title"><a href="{{ url('product', $product->id)}}">{{$product->title}}</a></h3>
                                @if($product->status_product === 'sold')
                                    <div class="price">{{$product->salePrice}}€
                                        <span>{{$product->price}}€</span>
                                    </div>
                                @else
                                    <div class="price">{{$product->price}}€</div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Désole pour l'instant aucun produit n'est publié sur le site</p>
                @endforelse

            </div>
        </div>
    </div>
    {{$products->links()}}

@endsection
