@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h2>Modification d'un produit :</h2>
                <form method="POST" action="{{route('product.update', $product->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT"/>
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" id="title" value="{{$product->title}}" name="title"
                               placeholder="Titre du produit">
                        @if($errors->has('title')) <span
                                class="error bg-warning text-warning">{{$errors->first('title')}}</span>@endif
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"
                                  rows="3">{{$product->description}}</textarea>
                        @if($errors->has('description')) <span
                                class="error">{{$errors->first('description')}}</span>@endif
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="price">Prix</label>
                        <input type="text" class="form-control" id="price"
                               value="{{($product->status_product == 'sold') ? $product->salePrice : $product->price}}"
                               name="price"
                               placeholder="Prix du produit">
                        @if($errors->has('price')) <span class="error">{{$errors->first('price')}}</span>@endif
                    </div>
                    <div class="form-group">
                        <label for="price">Catégories</label>
                        <select class="form-control form-control-lg" name="category_id">
                            <option id="0" value="" {{ is_null($product->category_id) ? 'selected' : '' }}>Pas de
                                catégorie
                            </option>
                            @forelse($categories as $id => $name)
                                <option id="{{$id}}"
                                        value="{{$id}}" {{ ($product->category_id == $id ) ? 'selected' : '' }}>{{$name}}</option>
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
                                   value="xs" {{ (is_array( unserialize($product->size)) and in_array('xs',  unserialize($product->size))) ? ' checked' : '' }}>XS
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="size[]"
                                   value="s" {{ (is_array( unserialize($product->size)) and in_array('s',  unserialize($product->size))) ? ' checked' : '' }}>S
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="size[]"
                                   value="m" {{ (is_array( unserialize($product->size)) and in_array('m',  unserialize($product->size))) ? ' checked' : '' }}>M
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="size[]"
                                   value="l" {{ (is_array( unserialize($product->size)) and in_array('l',  unserialize($product->size))) ? ' checked' : '' }}>L
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="size[]"
                                   value="xl" {{ (is_array( unserialize($product->size)) and in_array('xl',  unserialize($product->size))) ? ' checked' : '' }}>XL
                        </label>
                    </div>
                    @if($errors->has('size')) <span class="error">{{$errors->first('size')}}</span>@endif
                    <br>
                    <div class="form-group">
                        <label for="reference">Référence</label>
                        <input type="text" class="form-control" id="reference" value="{{$product->reference}}"
                               name="reference">
                        @if($errors->has('reference')) <span class="error">{{$errors->first('reference')}}</span>@endif
                    </div>

                    <h2>État du produit</h2>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_publish" id="published" value="1"
                               {{ ($product->status_publish == 1 ) ? 'checked' : '' }} checked>
                        <label class="form-check-label" for="published">
                            Publier
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_publish" id="unpublished"
                               value="0" {{ ($product->status_publish == 0 ) ? 'checked' : '' }}>
                        <label class="form-check-label" for="unpublished">
                            Dépublier
                        </label>
                    </div>

                    <h2>Statut du produit</h2>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_product" id="sold" value="sold"
                               {{ ($product->status_product == 'sold' ) ? 'checked' : '' }} checked>
                        <label class="form-check-label" for="sold">
                            Sold
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_product" id="standard"
                               value="standard" {{ ($product->status_product == 'standard' ) ? 'checked' : '' }}>
                        <label class="form-check-label" for="standard">
                            Standard
                        </label>
                    </div>
                    <h2>File : </h2>
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="picture" name="picture">
                        @if($errors->has('picture')) <span class="error">{{$errors->first('picture')}}</span>@endif
                    </div>
                    <div class="form-group">
                        <h2>Image associée :</h2>
                        <img src="{{ asset("images/".$product->image_url)}}" title="{{$product->title}}"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
@endsection