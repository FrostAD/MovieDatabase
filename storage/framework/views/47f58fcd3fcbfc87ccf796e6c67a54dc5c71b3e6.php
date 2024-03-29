<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($comment->user): ?>
        <div id="comment-<?php echo e($comment->id); ?>" class="d-flex flex-column comment-section">
            <div class="p-2">
                <div class="d-flex"><img src="<?php echo e(asset('storage/avatars/'.$comment->user->avatar)); ?>" width="50">
                    <div class="d-flex flex-column ml-2">
                        <span class="d-block font-weight-bold name"><?php echo e($comment->user->name); ?></span>
                        <span class="date text-black-50">Last modified: <?php echo e($comment->updated_at); ?></span>
                    </div>
                </div>
                <div class="mt-2">
                    <p class="comment-text"><?php echo e($comment->comment); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo $comments->links(); ?>

<?php /**PATH C:\Users\rstoi\Documents\GitHub\MovieDatabase\resources\views/partials/custom_replies.blade.php ENDPATH**/ ?>