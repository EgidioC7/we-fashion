@extends('layouts.master')

@section('content')

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-8">
                    <div class="product-grid7">
                        <div class="product-image7">
                            @if($product->image_url)
                                <a href="{{ asset('/images'.$product->image_url)}}" target><img class="img-thumbnail"
                                                                                 alt="{{$product->title}}"
                                                                                 src="{{ asset('/images/'.$product->image_url)}}"/></a>
                            @endif
                            @if($product->status_product === 'sold')
                                <span class="product-new-label">{{$product->status_product}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-8">
                    <h1>{{$product->title}}</h1>
                    <p>{{$product->description}}</p>
                    @if($product->status_product === 'sold')
                        <div class="price">{{$product->salePrice}}€
                            <del>{{$product->price}}€</del>
                        </div>
                    @else
                        <div class="price">{{$product->price}}€</div>
                    @endif
                    <select>
                        <option value="default">- Sélectionnez votre taille -</option>
                        @forelse(unserialize($product->size) as $size)
                            <option value="{{$size}}">{{$size}}</option>
                        @empty
                            <option value="empty">Aucune taille</option>
                        @endforelse
                    </select>
                    <button type="button" class="btn btn-primary">Acheter</button>
                </div>
            </div>
            <p>{{$product->description}}</p>
        </div>
    </div>
@endsection
