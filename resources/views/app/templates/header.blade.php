<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MovieStar</title>
    <link rel="shortcut icon" href="{{ asset('img/moviestar.ico') }}"/>
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.css" integrity="sha512-lp6wLpq/o3UVdgb9txVgXUTsvs0Fj1YfelAbza2Kl/aQHbNnfTYPMLiQRvy3i+3IigMby34mtcvcrh31U50nRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS PROJETO-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header>
    <nav id="main-navbar" class="navbar navbar-expand-lg">
        <a href="{{route('listMovies')}}" class="navbar-brand">
            <img src="{{asset('img/logo.svg')}}" alt="MovieStar" id="logo">
            <span id="moviestar-title">MovieStar</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars d-none"></i>
        </button>
        <form action="{{ route('search') }}" method="GET" id="search-form" class="form-inline my-2 my-lg-0">
            <div class="d-flex">
                <input type="text" name="q" id="search" class="form-control mr-sm-2" placeholder="Buscar Filmes" aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <a href="{{route('newMovie')}}" class="nav-link">
                            <i class="far fa-plus-square"></i> Incluir Filme
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('dashboardMovie')}}" class="nav-link">Meus Filmes</a>
                    </li>
                    @if (isset($name))
                        <li class="nav-item">
                            <a href="{{route('userProfile')}}" class="nav-link bold">{{$name}}</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{route('logout')}}" class="nav-link">Sair</a>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a href="{{ route('getAuth') }}" class="nav-link">Entrar / Cadastrar</a>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>
@if (session('message'))
    <div class="msg-container">
        <p class="msg {{ session('type') }}">{{ session('message') }}</p>
    </div>
    <?php session()->forget('message'); ?>
    <?php session()->forget('type'); ?>
@endif