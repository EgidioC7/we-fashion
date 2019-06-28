@extends('layouts.master')

@section('content')

    {{$products->links()}}
    @include('back.partials.flash')

    <button type="button" class="btn btn-primary">
        <a style="color:white" href="{{route('product.create')}}">Ajouter un produit</a>
    </button>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Prix</th>
            <th scope="col">État</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{$product->title}}</td>
                <td>{{$product->category->title}}</td>
                @if($product->status_product == 'sold')
                    <td>{{$product->salePrice}}</td>
                @else
                    <td>{{$product->price}}</td>
                @endif
                @if($product->status_publish)
                    <td>Disponible</td>
                @else
                    <td>Indisponible</td>
                @endif
                <td>
                    <button type="submit" class="btn btn-warning"><a
                                href="{{route('product.edit', $product->id)}}">Modifier</a></button>
                </td>
                <td>
                    <form class="delete" action="{{ route('product.destroy', $product->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{method_field('DELETE')}}
                        <button type="submit" class="delete btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection