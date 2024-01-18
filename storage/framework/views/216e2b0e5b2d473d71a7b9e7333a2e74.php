<div class="card movie-card">
        <?php if($movie->image && $movie->image !== 'default_image.jpg'): ?>
            <div class="card-img-top" style="background-image: url('<?php echo e(asset($movie->image)); ?>')"></div>
        <?php else: ?>
            <div class="card-img-top" style="background-image: url('<?php echo e(asset('img/movies/movie_cover.jpg')); ?>')"></div>
        <?php endif; ?>
        <div class="card-body">
            <p class="card-rating">
                <i class="fas fa-star" style="color: #f5c518;"></i>
                <?php if($movie->averageRating): ?>
                    <span class="rating" style="color: white"><?php echo e(number_format($movie->averageRating, 1)); ?></span>
                <?php else: ?>
                    <i style="color: white">N/A</i>
                <?php endif; ?>
            </p>
            <h5 class="card-title">
                <a href="#" style="text-decoration: none"><?php echo e($movie->title); ?></a>
            </h5>
            <a href="#" class="btn btn-primary rate-btn">Avaliar</a>
            <a href="<?php echo e(route('meetMovie', ['id' => $movie->id])); ?>" class="btn btn-primary card-btn">Conhecer</a>
        </div>
</div>
<?php /**PATH /var/www/html/resources/views/app/templates/movie_card.blade.php ENDPATH**/ ?>