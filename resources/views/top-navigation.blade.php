    <nav class="navbar navbar-expand-xl navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/katalog') }}">
            {{ config('app.name', 'EKP') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul id="top-nav" class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="/categories"><i class="bi bi-collection"></i>Kategorije</a></li>
                <li class="nav-item"><a class="nav-link" href="/publishers"><i class="bi bi-globe2"></i>Izdavači</a></li>
                <li class="nav-item"> <a class="nav-link" href="/authors/"><i class="bi bi-mortarboard"></i>Autori</a></li>
                <li class="nav-item"> <a class="nav-link" href="/donators"><i class="bi bi-gift"></i>Donatori</a></li>
                <li class="nav-item"> <a class="nav-link" href="/locations"><i class="bi bi-geo-alt"></i>Lokacije</a></li>
                <li class="nav-item"><a class="nav-link" href="/books"><i class="bi bi-book"></i>Naslovi</a></li>
                <li class="nav-item"><a class="nav-link" href="/borrowings"><i class="bi bi-arrow-left-right"></i>Iznajmljivanja</a></li>
                <li class="nav-item"><a class="nav-link" href="/readers"><i class="bi bi-people"></i>Čitaoci</a></li>
                <li class="nav-item"><a class="nav-link" href="/csvupload"><i class="bi bi-cloud-arrow-up"></i>Unos</a></li>
{{--                 <li class="nav-item"><a class="nav-link" href="/events"><i class="bi bi-newspaper"></i>Vesti</a></li>
                <li class="nav-item"><a class="nav-link" href="/donors"><i class="bi bi-bank"></i>Donatori/partneri</a></li>
                <li class="nav-item"><a class="nav-link" href="/projects"><i class="bi bi-box"></i>Kategorije za vesti</a></li>
                <li class="nav-item"><a class="nav-link" href="/blogs"><i class="bi bi-chat-square-quote"></i>Blogovi</a></li> --}}



            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Prijavi se</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Odjavi se
                                </a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


