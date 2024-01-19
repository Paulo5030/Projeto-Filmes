<?php echo $__env->make('app.templates.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <h1><?php echo e($movie->title); ?></h1>
                <p class="page-description">Altere os dados do filme no formulário abaixo:</p>
                <form id="edit-movie-form" action="<?php echo e(route('editMovie', ['id' => $movie->id])); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="type" value="update">
                    <input type="hidden" name="id" value="<?php echo e($movie->id); ?>">
                    <div class="form-group mb-3">
                        <label for="title" class="mb-2">Título:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Digite o titulo do seu filme" value="<?php echo e($movie->title); ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="image" class="mb-2">Imagem:</label>
                        <input type="file" class="form-control-file" name="image" id="image">
                    </div>
                    <div class="form-group mb-3">
                        <label for="length" class="mb-2">Duração:</label>
                        <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do filme" value="<?php echo e($movie->length); ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="category" class="mb-2">Categoria:</label>
                        <select name="category" id="category" class="form-control">
                            <option value="" disabled selected>Selecione</option>
                            <option value="Ação" <?php echo e($movie->category === 'Ação' ? 'selected' : ''); ?>>Ação</option>
                            <option value="Drama" <?php echo e($movie->category === 'Drama' ? 'selected' : ''); ?>>Drama</option>
                            <option value="Comédia" <?php echo e($movie->category === 'Comédia' ? 'selected' : ''); ?>>Comédia</option>
                            <option value="Aventura"  <?php echo e($movie->category === 'Aventura' ? 'selected' : ''); ?>>Aventura</option>
                            <option value="Terror" <?php echo e($movie->category === 'Terror' ? 'selected' : ''); ?>>Terror</option>
                            <option value="Fantasia / Ficção" <?php echo e($movie->category === 'Fantasia / Ficção' ? 'selected' : ''); ?>>Fantasia / Ficção</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="trailer" class="mb-2">Trailer:</label>
                        <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer" value="<?php echo e($movie->trailer); ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="mb-2">Descrição:</label>
                        <textarea name="description" id="description" rows="5" class="form-control" placeholder="Decreva o filme..."><?php echo e($movie->description); ?></textarea>
                    </div>
                    <div  style="width: 150px;">
                        <input type="submit" class="btn card-btn" value="Editar Filme">
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                <?php if($movie->image && $movie->image !== 'default_image.jpg'): ?>
                    <div class="movie-image" style="background-image: url('<?php echo e(asset($movie->image)); ?>'); width: 100%; height: 600px; background-size: auto 100%; background-repeat: no-repeat; background-position: center;"></div>
                <?php else: ?>
                    <div class="movie-image" style="background-image: url('<?php echo e(asset('img/movies/movie_cover.jpg')); ?>'); width: 100%; height: 300px; background-size: cover;"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('app.templates.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/app/editMovie.blade.php ENDPATH**/ ?>