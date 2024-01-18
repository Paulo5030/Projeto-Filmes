@include('app.templates.header')

<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-1 col-md-6 movie-container">
            <h1 class="page-title">{{$movie->title}}</h1>
            <p class="movie-details">
                <span>Duração: {{$movie->length}}</span>
                <span class="pipe"></span>
                <span>{{$movie->category}}</span>
                <span class="pipe"></span>
                <i class="fas fa-star"></i>
                @if ($movie->averageRating)
                    <span class="rating" style="color: white">{{ number_format($movie->averageRating, 1) }}</span>
                @else
                    <i style="color: white">N/A</i>
                @endif
            </p>
            <iframe src="{{$movie->trailer}}" width="560" height="315" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <p>{{$movie->description}}</p>
        </div>
        <div class="col-md-4">
            @if ($movie->image && $movie->image !== 'default_image.jpg')
                <div class="movie-image" style="background-image: url('{{ asset($movie->image) }}'); width: 100%; height: 600px; background-size: auto 100%; background-repeat: no-repeat; background-position: center;"></div>
            @else
                <div class="movie-image" style="background-image: url('{{ asset('img/movies/movie_cover.jpg') }}'); width: 100%; height: 300px; background-size: cover;"></div>
            @endif
        </div>
        <div class="offset-md-1 col-md-10" id="reviews-container">
            <h3 id="reviews-title">Avaliações:</h3>
            <div class="col-md-12" id="review-form-container">
                <h4>Envie sua avaliação:</h4>
                <p class="page-description">Preencha o formulario com a nota e comentário sobre o filme</p>
                <form action="{{route('addMovie')}}" id="review-form" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="create">
                    <input type="hidden" name="movies_id" value="{{$movie->id}}">
                    <div class="form-group">
                        <label for="rating" class="mb-3">Nota do filme:</label>
                        <select name="rating" id="rating" class="form-control mb-3">
                            <option value="">Selecione</option>
                            <option value="10">10</option>
                            <option value="9">9</option>
                            <option value="8">8</option>
                            <option value="7">7</option>
                            <option value="6">6</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review" class="mb-3">Seu comentário:</label>
                        <textarea name="review" id="review" rows="3" class="form-control" placeholder="O que você achou do filme?"></textarea>
                    </div>
                    <div class="col-md-2" id="add-movie-container mb-4">
                    <input type="submit" class="btn card-btn btn-sm-width mt-4" value="Enviar Comentário">
                    </div>
                </form>
        </div>
</div>

@include('app.templates.footer')