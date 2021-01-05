<ol id="all-events-list" class="list-group">
    <?php echo csrf_field(); ?>
    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="list-group-item">
            <a href='/event/<?php echo e($event->id); ?>' class="float-left">
                <img src="<?php echo e(asset('storage/' . App\Models\Movie::find($event->movie_id)->poster)); ?>">
            </a>
            <span class="font-weight-bold ml-2 w-100"><?php echo e($event->name); ?></span>
            <span class="ml-2"><?php echo e($event->current_cappacity); ?>/<?php echo e($event->capacity); ?>

            </span>
            <div class="mt-3 p-3" style="margin-left: 150px; background-color: #efefef; border-radius: 3px;">
                <p class="small"><?php echo e($event->description); ?>

                </p>
            </div>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>
<?php echo $events->links(); ?>

<?php /**PATH C:\Users\rstoi\Documents\GitHub\MovieDatabase\resources\views/index/events_only.blade.php ENDPATH**/ ?>