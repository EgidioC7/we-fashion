<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#" onclick="return false;">WE FASHION</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        <li><a class="nav-link" href="{{route('product.index')}}">Produit</a></li>
        <li><a class="nav-link" href="{{route('category.index')}}">Catégorie</a></li>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li><a class="nav-link" href="{{route('product.index')}}">Produit</a></li>
            <li><a class="nav-link" href="{{route('category.index')}}">Catégorie</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            {{-- renvoie true si vous êtes connecté --}}
            @if(Auth::check())
                <li><a class="nav-link" href="{{url('/')}}"><i class="fas fa-home"></i></a></li>
                <li>
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endif
        </ul>

    </div>
</nav>
