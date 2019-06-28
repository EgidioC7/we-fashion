<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{url('/')}}">WE FASHION</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
            @if(isset($categories))
                @forelse($categories as $category)
                    <li><a class="nav-link" href="{{url('category/'.$category->title )}}">{{$category->title}}</a></li>
                @empty
                    <li>Aucun catégorie</li>
                @endforelse
            @endif
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
                <li><a class="nav-link" href="{{url('sold' )}}">Solde</a></li>
            @if(isset($categories))
                @forelse($categories as $category)
                    <li><a class="nav-link" href="{{url('category/'.$category->title )}}">{{$category->title}}</a></li>
                @empty
                    <li>Aucune catégorie</li>
                @endforelse
            @endif
        </ul>
        <ul class="nav navbar-nav navbar-right">
            {{-- renvoie true si vous êtes connecté --}}
            @if(Auth::check())
                <li><a class="nav-link" href="{{route('product.index')}}">Dashboard</a></li>
                <li>
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endif
            @if(Request::is('product/*') == false)
                <li class="nav-item"><a class="nav-link" href="" onclick="return false;">Nb de produits
                        : {{\App\Http\Controllers\FrontController::getNbProducts($selectCount)}}</a></li>
            @endif
        </ul>

    </div>
</nav>
