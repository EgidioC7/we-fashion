@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h2>Modification d'une catégorie :</h2>
                <form method="POST" action="{{route('category.update', $category->id)}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT"/>
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" id="title" value="{{$category->title}}" name="title"
                               placeholder="Titre du catégorie">
                        @if($errors->has('title')) <span class="error">{{$errors->first('title')}}</span>@endif
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
@endsection