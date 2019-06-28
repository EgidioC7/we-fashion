@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h2>Création d'un produit :</h2>
                <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" id="title" value="{{old('title')}}" name="title"
                               placeholder="Titre du produit">
                        @if($errors->has('title')) <span class="error">{{$errors->first('title')}}</span>@endif
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"
                                  rows="3">{{old('description')}}</textarea>
                        @if($errors->has('description')) <span
                                class="error">{{$errors->first('description')}}</span>@endif
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="price">Prix</label>
                        <input type="text" class="form-control" id="price" value="{{old('price')}}" name="price"
                               placeholder="Prix du produit">
                        @if($errors->has('price')) <span class="error">{{$errors->first('price')}}</span>@endif
                    </div>
                    <div class="form-group">
                        <label for="price">Catégories</label>
                        <select class="form-control form-control-lg" name="category_id">
                            <option id="0" value="" {{ is_null(old('category_id')) ? 'selected' : '' }}>Pas de catégorie
                            </option>
                            @forelse($categories as $id => $title)
                                <option id="{{$id}}"
                                        value="{{$id}}" {{ (old('category_id') == $id ) ? 'selected' : '' }}>{{$title}}</option>
                            @empty
                                <option>Aucune catégorie</option>
                            @endforelse
                        </select>
                        @if($errors->has('category_id')) <span
                                class="error">{{$errors->first('category_id')}}</span>@endif
                    </div>
                    <br>
                    <div class="form-group">
                        <h2 for="price">Taille</h2>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="size[]"
                                   value="xs" {{ (is_array(old('size')) and in_array('xs', old('size'))) ? ' checked' : '' }}>XS
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="size[]"
                                   value="s" {{ (is_array(old('size')) and in_array('s', old('size'))) ? ' checked' : '' }}>S
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="size[]"
                                   value="m" {{ (is_array(old('size')) and in_array('m', old('size'))) ? ' checked' : '' }}>M
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="size[]"
                                   value="l" {{ (is_array(old('size')) and in_array('l', old('size'))) ? ' checked' : '' }}>L
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="size[]"
                                   value="xl" {{ (is_array(old('size')) and in_array('xl', old('size'))) ? ' checked' : '' }}>XL
                        </label>
                    </div>
                    @if($errors->has('size')) <span class="error">{{$errors->first('size')}}</span>@endif
                    <br>
                    <div class="form-group">
                        <label for="reference">Référence</label>
                        <input type="text" class="form-control" id="reference" value="{{old('reference')}}"
                               name="reference">
                        @if($errors->has('reference')) <span class="error">{{$errors->first('reference')}}</span>@endif
                    </div>

                    <h2>État du produit</h2>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_publish" id="published" value="1"
                               {{ (old('status_publish') == 1 ) ? 'checked' : '' }}>
                        <label class="form-check-label" for="published">
                            Publier
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_publish" id="unpublished"
                               value="0" {{ (old('status_publish') == 0 ) ? 'checked' : '' }}>
                        <label class="form-check-label" for="unpublished">
                            Dépublier
                        </label>
                    </div>

                    <h2>Statut du produit</h2>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_product" id="sold" value="sold"
                               {{ (old('status_product') == 'sold' ) ? 'checked' : '' }} checked>
                        <label class="form-check-label" for="sold">
                            Sold
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_product" id="standard"
                               value="standard" {{ (old('status_product') == 'standard' ) ? 'checked' : '' }}>
                        <label class="form-check-label" for="standard">
                            Standard
                        </label>
                    </div>
                    <h2>File : </h2>
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="picture" name="picture">
                        @if($errors->has('picture')) <span class="error">{{$errors->first('picture')}}</span>@endif
                    </div>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </form>
            </div>
        </div>
    </div>
@endsection