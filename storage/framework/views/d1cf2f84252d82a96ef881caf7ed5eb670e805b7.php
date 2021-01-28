<ul class="list-group">
    <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="list-group-item"><a href="/movie/<?php echo e($movie->id); ?>"><?php echo e($movie->title); ?></a>  -   <?php echo e($movie->rating); ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php echo $movies->links(); ?>

<?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/view/actor_movies.blade.php ENDPATH**/ ?>