<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evidencija radnog vremena</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
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
            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Naslovna</a>
            </li>
            @auth
                @if (Auth::user()->role_id != 1)
                    <li class="nav-item">
                        <a class="nav-link" href="#">Moj ERV</a>
                    </li>
                @endif
            @endauth
            @auth
                @if (Auth::user()->role_id != 2)
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('users.index') }}">Korisnici</a>
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
            @endguest
        </ul>
        
        </div>

    </div>
    </nav>



    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>