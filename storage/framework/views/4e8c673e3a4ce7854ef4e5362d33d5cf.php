<?php echo $__env->make('app.templates.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title" style="font-size: 40px;">Você está buscando por: <span class="text-warning"><?php echo e($q); ?></span></h2>
    <p class="section-description">Resultados da busca a partir da sua pesquisa:</p>
    <div class="movies-container">
        <?php if(isset($movieNovos)): ?>
        <?php if(count($movieNovos) > 0): ?>
            <?php $__currentLoopData = $movieNovos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('app.templates.movie_card', ['movie' => $movie], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p class="empty-list text-center mx-auto" style="font-size: 25px">Não há filmes para essa busca: <a href="<?php echo e(route('listMovies')); ?>" style="color: #f5c518;" class="text-decoration-none">Voltar</a></p>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php echo $__env->make('app.templates.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /var/www/html/resources/views/app/search.blade.php ENDPATH**/ ?>