@extends('layouts.master')

@section('content')

    {{$categories->links()}}
    @include('back.partials.flash')

    <button type="button" class="btn btn-primary">
        <a style="color:white" href="{{route('category.create')}}">Ajouter une catégorie</a>
    </button>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->title  }}</td>
                <td>
                    <button type="submit" class="btn btn-warning"><a
                                href="{{route('category.edit', $category->id)}}">Modifier</a></button>
                </td>
                <td>
                    <form class="delete" action="{{ route('category.destroy', $category->id) }}" method="POST">
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