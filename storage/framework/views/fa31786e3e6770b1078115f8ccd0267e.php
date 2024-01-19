 <div class="col-md-12 review">
            <div class="row">
                <div class="col-md-1">
                    <?php if($review->user->image && $review->user->image !== 'default_image.jpg'): ?>
                        <div class="profile-image-container review-image" style="background-image: url('<?php echo e(asset($review->user->image)); ?>')"></div>
                    <?php else: ?>
                        <div class="profile-image-container review-image" style="background-image: url('<?php echo e(asset('img/users/user.png')); ?>')"></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-9 author-details-container">
                    <h4 class="author-name">
                        <a href="<?php echo e(route('profile', ['id' => $review->user->id])); ?>" style="text-decoration: none"><?php echo e($review->user->name); ?></a>
                    </h4>
                    <div class="star-rating">
                        <i class="fas fa-star" style="margin-right: 4px;"></i><?php echo e($review->rating); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <p class="comment-title">Comentário:</p>
                    <p><?php echo e($review->review); ?></p>
                </div>
            </div>
 </div>
<?php /**PATH /var/www/html/resources/views/app/templates/user_review.blade.php ENDPATH**/ ?>