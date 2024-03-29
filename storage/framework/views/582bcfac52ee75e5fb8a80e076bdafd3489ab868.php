
<?php $__env->startSection('body'); ?>
<div class="container">
    <section id="section-recently-added">
        <h3 class="my-3">Recently Added</h3>
        <?php if($last_movie): ?>
            <div class="row text-center">
                <div class="col-md-6">
                    <a href="movie/<?php echo e($last_movie->id); ?>">
                        <img src="<?php echo e('storage/'. $last_movie->poster); ?>" alt="Recently added movie"/>
                    </a>
                </div>
                <div id="info-recently-added" class="col-md-6 scrollbar-hidden">
                    <h3><?php echo e($last_movie->title); ?></h3>
                    <p>
                        <?php echo e($last_movie->description); ?>

                    </p>
                </div>
            </div>
        <?php endif; ?>
    </section>

    <!-- Section-2: Scrollable Menu -->
    <h3>Action Movies</h3>
    <div class="selector-page scrollbar-hidden">
      <ul>
        <?php if($movies_action): ?>
                <?php $__currentLoopData = $movies_action; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie_action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <li><a href="#"><img src="<?php echo e(asset('storage/'.$movie_action->poster)); ?>" width="170px"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
      </ul>
    </div>
    <h3>Drama Movies</h3>
    <div class="selector-page scrollbar-hidden">
      <ul>
        <?php if($movies_drama): ?>
                <?php $__currentLoopData = $movies_drama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie_drama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <li><a href="#"><img src="<?php echo e(asset('storage/'.$movie_drama->poster)); ?>" width="170px"></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/home2.blade.php ENDPATH**/ ?>