@include('app.templates.header')

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Filmes novos</h2>
    <p class="section-description">Veja as críticas dos últimos filmes adicionados no MovieStar</p>
    <div class="movies-container">
        @isset($movieNovos)
            @if (count($movieNovos) > 0)
                @foreach ($movieNovos as $movie)
                    @include('app.templates.movie_card')
                @endforeach
            @else
                <p class="empyt-list">Ainda não há filmes novos cadastrados</p>
            @endif
        @endisset
    </div>
    <h2 class="section-title">Ação</h2>
    <p class="section-description">Veja os melhores filmes de ação</p>
    <div class="movies-container">
        @isset($movieAcao)
            @if (count($movieAcao) > 0)
                @foreach ($movieAcao as $movie)
                    @include('app.templates.movie_card')
                @endforeach
            @else
                <p class="empyt-list">Ainda não há filmes de ação cadastrados</p>
            @endif
        @endisset
    </div>
    <h2 class="section-title">Comédia</h2>
    <p class="section-description">Veja os melhores filmes de comédia</p>
    <div class="movies-container">
        @isset($movieComedia)
            @if (count($movieComedia) > 0)
                @foreach ($movieComedia as $movie)
                    @include('app.templates.movie_card')
                @endforeach
            @else
                <p class="empyt-list">Ainda não há filmes de comédia cadastrados</p>
            @endif
        @endisset
    </div>
</div>

@include('app.templates.footer')
