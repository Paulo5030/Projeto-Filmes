<?php echo $__env->make('app.templates.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div id="main-container" class="container-fluid">
    <div class="offset-md-4 col-md-4 new-movie-container">
        <h1 class="page-title">Adicionar Filme</h1>
        <p class="page-description">Adicione sua critica e compartilhe com o mundo!</p>
        <form action="<?php echo e(route('addMovie')); ?>" id="add-movie-form" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="type" value="create">
            <div class="form-group mb-3">
                <label for="title" class="mb-2">Título:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Digite o titulo do seu filme">
            </div>
            <div class="form-group mb-3">
                <label for="image" class="mb-2">Imagem:</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <div class="form-group mb-3">
                <label for="length" class="mb-2">Duração:</label>
                <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do filme">
            </div>
            <div class="form-group mb-3">
                <label for="category" class="mb-2">Categoria:</label>
                <select name="category" id="category" class="form-control">
                    <option value="" disabled selected>Selecione</option>
                    <option value="Ação">Ação</option>
                    <option value="Drama">Drama</option>
                    <option value="Comédia">Comédia</option>
                    <option value="Aventura">Aventura</option>
                    <option value="Terror">Terror</option>
                    <option value="Fantasia / Ficção">Fantasia / Ficção</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="trailer" class="mb-2">Trailer:</label>
                <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer">
            </div>
            <div class="form-group mb-3">
                <label for="description" class="mb-2">Descrição:</label>
                <textarea name="description" id="description" rows="5" class="form-control" placeholder="Decreva o filme..."></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Adicionar Filme">
        </form>
    </div>
</div>
<?php echo $__env->make('app.templates.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/app/newmovie.blade.php ENDPATH**/ ?>