<ol id="all-movies-list" class="list-group">
    <?php echo csrf_field(); ?>
    <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($loop->index ==0 || $loop->index == 3): ?>
            <div class="row">
            <?php endif; ?>
            <!-- One Movie -->
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip">
                        <div class="mainflip flip-0">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <h4 class="card-title"><?php echo e($movie->title . '(' . $movie->published . ')'); ?></h4>
                                        <img src="<?php echo e(asset('storage/' . $movie->poster)); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="backside scrollbar-hidden">
                                <div class="card ">
                                    <div class="card-body text-center mt-4">
                                        <h4 class="card-title"><?php echo e($movie->title); ?> <a href="/movie/<?php echo e($movie->id); ?>"><i
                                                    class="fa fa-file"></i></a></h4>
                                        <p><?php echo e($movie->description); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($loop->index == 2 || $loop->index == 5): ?>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>
<?php echo $movies->links(); ?>

<?php /**PATH C:\Users\rstoi\Documents\GitHub\MovieDatabase\resources\views/index/movies_only.blade.php ENDPATH**/ ?>