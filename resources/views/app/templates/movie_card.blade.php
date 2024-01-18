<div class="card movie-card">
        @if ($movie->image && $movie->image !== 'default_image.jpg')
            <div class="card-img-top" style="background-image: url('{{ asset($movie->image) }}')"></div>
        @else
            <div class="card-img-top" style="background-image: url('{{ asset('img/movies/movie_cover.jpg') }}')"></div>
        @endif
        <div class="card-body">
            <p class="card-rating">
                <i class="fas fa-star" style="color: #f5c518;"></i>
                @if ($movie->averageRating)
                    <span class="rating" style="color: white">{{ number_format($movie->averageRating, 1) }}</span>
                @else
                    <i style="color: white">N/A</i>
                @endif
            </p>
            <h5 class="card-title">
                <a href="#" style="text-decoration: none">{{$movie->title}}</a>
            </h5>
            <a href="#" class="btn btn-primary rate-btn">Avaliar</a>
            <a href="{{route('meetMovie', ['id' => $movie->id])}}" class="btn btn-primary card-btn">Conhecer</a>
        </div>
</div>
