<?php echo $__env->make('app.templates.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($welcomeMessage)): ?>
    <div class="alert alert-success">
        <?php echo e($welcomeMessage); ?>

    </div>
<?php endif; ?>

<div id="main-container" class="container-fluid edit-profile-page">
    <div class="col-md-12">
        <form action="<?php echo e(route('updateUser')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="type" value="update">
            <div class="row">
                <div class="col-md-4">
                    <h1><?php echo e($name); ?> <?php echo e($lastname); ?></h1>
                    <p class="page-description">Altere seus dados no formulário abaixo:</p>

                    <div class="form-group mb-3">
                        <label for="name" class="mb-2">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome" value="<?php echo e($name); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="lastname" class="mb-2">Sobrenome:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite seu sobrenome" value="<?php echo e($lastname); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="mb-2">E-mail:</label>
                        <input type="text" readonly class="form-control text-muted" id="email" name="email" placeholder="Digite seu email" value="<?php echo e($email); ?>" disabled>
                    </div>

                    <input type="submit" class="btn card-btn" value="Alterar">
                </div>

                <div class="col-md-4">
                    <?php if($image && $image !== 'default_image.jpg'): ?>
                        <div id="profile-image-container" style="background-image: url('<?php echo e(asset($image)); ?>')"></div>
                    <?php else: ?>
                        <div id="profile-image-container" style="background-image: url('<?php echo e(asset('img/users/user.png')); ?>')"></div>
                    <?php endif; ?>
                    <label for="image" class="mb-2">Foto:</label>
                    <div class="form-group mb-3">
                        <input type="file" class="form-control-file" name="image">
                    </div>
                    <div class="form-group mb-3">
                        <label for="bio" class="mb-2">Sobre você:</label>
                        <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Conte quem você é, o que faz e onde trabalha..."><?php echo e($bio); ?></textarea>
                    </div>
                </div>
            </div>
        </form>
        <div class="row" id="change-password-container">
            <div class="col-md-4">
                <h2>Alterar a senha:</h2>
                <p class="page-description">Digite a nova senha e confirme para alterar a senha:</p>

                <form action="<?php echo e(route('updatePassword')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="type" value="changepassword">

                    <div class="form-group mb-3">
                        <label for="password" class="mb-2">Senha:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Digite a nova senha">
                    </div>

                    <div class="form-group mb-3">
                        <label for="confirmpassword" class="mb-2">Confirmação de senha:</label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme a nova senha">
                    </div>

                    <input type="submit" class="btn card-btn" value="Alterar Senha">
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('app.templates.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /var/www/html/resources/views/app/login.blade.php ENDPATH**/ ?>