@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h2>Création d'une catégorie :</h2>
                <form method="POST" action="{{route('category.store')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" id="title" value="{{old('title')}}" name="title"
                               placeholder="Titre du catégorie">
                        @if($errors->has('title')) <span class="error">{{$errors->first('title')}}</span>@endif
                    </div>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </form>
            </div>
        </div>
    </div>
@endsection