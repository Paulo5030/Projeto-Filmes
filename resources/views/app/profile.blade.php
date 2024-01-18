@include('app.templates.header')

<div id="main-container" class="container-fluid">
    <div class="col-md-8 offset-md-2">
        <div class="row" style=" text-align: center;">
            <div class="col-md-12" style=" background-color: #333;  border-bottom: 3px solid #ccc;">
                <h1 class="page-title">{{$user->name}}</h1>
                @if ($image && $image !== 'default_image.jpg')
                    <div id="profile-image-container" class="profile-image" style="background-image: url('{{ asset($image) }}')"></div>
                @else
                    <div id="profile-image-container" class="profile-image" style="background-image: url('{{ asset('img/users/user.png') }}')"></div>
                @endif
                <h3 class="about-title">Sobre:</h3>
                @if(isset($user->bio))
                    <p class="profile-description" style=" max-width: 500px;  margin: 20px auto;">{{$user->bio}}</p>
                @else
                    <p class="profile-description">O usuario ainda não escreveu nada aqui...</p>
                @endif
            </div>
        </div>
        <div class="row">
           <div class="col-md-12" style="background-color: #333; padding: 30px;">
               <h3 style="margin-top: 20px;">Filmes que enviou:</h3>
                <div class="movies-container">
                   @isset($movies)
                       @if (count($movies) > 0)
                           @foreach ($movies as $movie)
                               @include('app.templates.movie_card', [['hasReviewed' => $hasReviewed]])
                           @endforeach
                       @else
                           <p class="empty-list">Ainda não há filmes cadastrados</p>
                       @endif
                   @endisset
                </div>
            </div>
       </div>
    </div>
</div>
@include('app.templates.footer')