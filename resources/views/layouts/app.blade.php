<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evidencija radnog vremena</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top bg-info-subtle" data-bs-theme="dark">
    <div class="container-fluid bg-info-subtle align-items-center">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand mb-0 pe-3 fs-5 border-end" aria-label="Disabled select example">Evidencija radnog vremena</a>

        <div class="collapse navbar-collapse mt-1" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-0 ms-lg-0 text-center">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('home') ? 'active' : '' }} btn" aria-current="page" href="{{ route('home') }}">Naslovna</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('tasks.index') ? 'active' : '' }} btn" aria-current="page" href="{{ route('tasks.index') }}">Taskovi</a>
            </li>
            @auth
                @if (Auth::user()->role_id != 1)
                    <li class="nav-item">
                        <a class="nav-link btn" href="#">Moj ERV</a>
                    </li>
                @endif
            @endauth
            @auth
                @if (Auth::user()->role_id != 2)
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('users.index') ? 'active' : '' }} btn" href="{{ route('users.index') }}">Korisnici</a>
                    </li>
                @endif
            @endauth
            @auth
            </a>
                @if (Auth::user()->role_id == 1)
                <li class="nav-item d-flex align-items-center">
                    <span class="border-end me-2 pe-2 align-self-stretch"></span>
                    <div class="dropdown">
                        <a class="nav-link {{ Route::is('company_profiles.index') || Route::is('settings.index') ? 'active' : '' }} btn dropdown-toggle"
                            href="#" 
                            role="button" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false">
                            Administracija
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('company_profiles.index') }}">Profili tvrtki</a></li>
                            <li><a class="dropdown-item" href="{{ route('settings.index') }}">Odjeli i role</a></li>
                        </ul>
                    </div>
                </li>
                @endif
            @endauth    
        </ul>
        <ul class="navbar-nav ms-auto d-flex align-items-center">
            @auth
                <li class="nav-item me-2">
                    <span class="navbar-text text-white p-2">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </span>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm">Odjava</button>
                    </form>
                </li>
            @endauth
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Prijava</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Registracija</a>
                </li>
            @endguest
        </ul>
        
        </div>

    </div>
    </nav>



    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>