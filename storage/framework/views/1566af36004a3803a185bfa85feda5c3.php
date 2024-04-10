<?php echo $__env->make('app.templates.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div id="main-container" class="container-fluid">
    <div class="col-md-8 offset-md-2">
        <div class="row" style=" text-align: center;">
            <div class="col-md-12" style=" background-color: #333;  border-bottom: 3px solid #ccc;">
                <h1 class="page-title"><?php echo e($user['name']); ?></h1>
                <?php if($user['image'] && $user['image'] !== 'default_image.jpg'): ?>
                    <div id="profile-image-container" class="profile-image" style="background-image: url('<?php echo e(asset($user['image'])); ?>')"></div>
                <?php else: ?>
                    <div id="profile-image-container" class="profile-image" style="background-image: url('<?php echo e(asset('img/users/user.png')); ?>')"></div>
                <?php endif; ?>
                <h3 class="about-title">Sobre:</h3>
                <?php if(isset($user['bio'])): ?>
                    <p class="profile-description" style=" max-width: 500px;  margin: 20px auto;"><?php echo e($user['bio']); ?></p>
                <?php else: ?>
                    <p class="profile-description">O usuario ainda não escreveu nada aqui...</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
           <div class="col-md-12" style="background-color: #333; padding: 30px;">
               <h3 style="margin-top: 20px;">Filmes que enviou:</h3>
                <div class="movies-container">
                   <?php if(isset($movies)): ?>
                       <?php if(count($movies) > 0): ?>
                           <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <?php echo $__env->make('app.templates.movie_card', [['hasReviewed' => $hasReviewed]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       <?php else: ?>
                           <p class="empty-list">Ainda não há filmes cadastrados</p>
                       <?php endif; ?>
                   <?php endif; ?>
                </div>
            </div>
       </div>
    </div>
</div>
<?php echo $__env->make('app.templates.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/app/profile.blade.php ENDPATH**/ ?>