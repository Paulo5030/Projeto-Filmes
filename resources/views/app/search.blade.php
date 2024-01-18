@include('app.templates.header')

<div id="main-container" class="container-fluid">
    <h2 class="section-title" style="font-size: 40px;">Você está buscando por: <span class="text-warning">{{$q}}</span></h2>
    <p class="section-description">Resultados da busca a partir da sua pesquisa:</p>
    <div class="movies-container">
        @isset($movieNovos)
        @if (count($movieNovos) > 0)
            @foreach ($movieNovos as $movie)
                @include('app.templates.movie_card', ['movie' => $movie])
            @endforeach
        @else
            <p class="empty-list text-center mx-auto" style="font-size: 25px">Não há filmes para essa busca: <a href="{{route('listMovies')}}" style="color: #f5c518;" class="text-decoration-none">Voltar</a></p>
        @endif
        @endisset
    </div>
</div>

@include('app.templates.footer')
