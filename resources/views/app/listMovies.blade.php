@include('app.templates.header')

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Filmes novos</h2>
    <p class="section-description">Veja as críticas dos últimos filmes adicionados no MovieStar</p>
    <div class="movies-container">
        @isset($movies)
            @if (count($movies) > 0)
                @foreach ($movies as $movie)
                    @include('app.templates.movie_card')
                @endforeach
            @else
                <p class="empty-list">Ainda não há filmes cadastrados</p>
            @endif
        @endisset
    </div>
</div>

@include('app.templates.footer')
