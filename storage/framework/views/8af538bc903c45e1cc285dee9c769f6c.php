<?php echo $__env->make('app.templates.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashboard</h2>
    <p class="section-description">Adicione ou atualize as informações dos filmes que você enviou</p>
    <div class="row justify-content-end">
        <div class="col-md-2" id="add-movie-container" style="margin-bottom: 20px">
            <a href="<?php echo e(route('newMovie')); ?>" class="btn card-btn">
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
            <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($movie->id); ?></td>
                <td><a href="<?php echo e(route('getMovie', ['id' => $movie->id])); ?>" class="table-movie-title" style="text-decoration: none"><?php echo e($movie->title); ?></a></td>
                <td><i class="fas fa-star" style="margin-right: 4px;"></i>
                    <?php if($movie->averageRating): ?>
                        <span class="rating" style="color: white"><?php echo e(number_format($movie->averageRating, 1)); ?></span>
                    <?php else: ?>
                        <i style="color: white">N/A</i>
                    <?php endif; ?>
                </td>
                <td class="actions-column">
                    <a href="<?php echo e(route('viewPageEditiMovie', ['id' => $movie->id])); ?>" class="edit-btn" style="text-decoration: none">
                        <i class="far fa-edit"></i> Editar
                    </a>
                    <form action="<?php echo e(route('deleteMovie', ['id' => $movie->id])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <input type="hidden" name="type" value="delete">
                        <input type="hidden" name="id" value="<?php echo e($movie->id); ?>">
                        <button type="submit" class="delete-btn">
                            <i class="fas fa-times"></i> Deletar
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<?php echo $__env->make('app.templates.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /var/www/html/resources/views/app/dashboard.blade.php ENDPATH**/ ?>