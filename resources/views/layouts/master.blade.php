<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>We Fashion</title>
    <link href="{{asset("css/app.css")}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(Route::is('product.*') == false && Route::is('category.*') == false )
                @include('partials.menu')
            @else
                @include('partials.adminMenu')
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>
    @include('partials.footer')
</div>
<!--<script src="{{asset('js/app.js')}}"></script>-->
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@show
</body>
</html>