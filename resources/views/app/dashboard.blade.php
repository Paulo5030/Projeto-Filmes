@include('app.templates.header')

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashboard</h2>
    <p class="section-description">Adicione ou atualize as informações dos filmes que você enviou</p>
    <div class="row justify-content-end">
        <div class="col-md-2" id="add-movie-container" style="margin-bottom: 20px">
            <a href="{{route('newMovie')}}" class="btn card-btn">
                <i class="fas fa-plus"></i> Adicionar Filme
            </a>
        </div>
</div>
    <div class="col-md-12" id="movies-dashboard">
        <table>
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Nota</th>
                <th scope="col" class="actions-column">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($movies as $movie)
            <tr>
                <td>{{$movie->id}}</td>
                <td><a href="{{ route('getMovie', ['id' => $movie->id])}}" class="table-movie-title" style="text-decoration: none">{{$movie->title}}</a></td>
                <td><i class="fas fa-star" style="margin-right: 4px;"></i>
                    @if ($movie->averageRating)
                        <span class="rating" style="color: white">{{ number_format($movie->averageRating, 1) }}</span>
                    @else
                        <i style="color: white">N/A</i>
                    @endif
                </td>
                <td class="actions-column">
                    <a href="{{route('viewPageEditiMovie', ['id' => $movie->id])}}" class="edit-btn" style="text-decoration: none">
                        <i class="far fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('deleteMovie', ['id' => $movie->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="type" value="delete">
                        <input type="hidden" name="id" value="{{$movie->id}}">
                        <button type="submit" class="delete-btn">
                            <i class="fas fa-times"></i> Deletar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('app.templates.footer')
