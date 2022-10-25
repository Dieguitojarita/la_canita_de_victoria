<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
        integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
        integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fancybox.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.theme.default.min.css') }}" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <title>@yield('titulo')</title>
</head>

<body class="bg-dark">


    <nav class="navbar navbar-expand-lg">
        <div class="container"> <a class="navbar-brand text-light" href="">Gestión de reservas</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span
                    class="fas fa-bars"></span> </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            reservas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-dark" href="{{ route('reservas.index') }}">Ver</a></li>
                            @can(['administrador'])
                                <li><a class="dropdown-item text-dark" href="{{ route('reservas.create') }}">Crear
                                        nuevo</a></li>
                            @endcan
                        </ul>
                    </li>
                    @can(['administrador'])
                        <li class="nav-item ">
                            <a class="nav-link text-light" href="{{ route('usuarios.index') }}">Usuarios</a>
                        </li>
                    @endcan
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar..." name="buscar"
                        aria-label="Buscar">
                    <button class="btn btn-outline-light" type="submit">Buscar</button>
                </form>
                <ul class="navbar-nav text-dark ms-3">
                    @can(['administrador'])
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu text-dark">
                            <li>
                                <a class="dropdown-item text-dark" href="{{ route('logout') }}"></a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                </ul>
            </div>
        </div>
    </nav>
    <h1 class="text-center mt-4">@yield('titulo')</h1>

    <div class="my-3 container">
        @yield('content')
    </div>

    <script src="{{ asset('css/bootstrap/js/bootstrap.bundle.js') }}"></script>
    @yield('scripts')
</body>

</html>
