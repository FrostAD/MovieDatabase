<ol id="all-events-list" class="list-group">
    <?php echo csrf_field(); ?>
    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$event->movie == null): ?>
        <li class="list-group-item">
            <a href='/event/<?php echo e($event->id); ?>' class="float-left">
                <img src="<?php echo e(asset('storage/' . App\Models\Movie::find($event->movie_id)->poster)); ?>">
            </a>
            <span class="font-weight-bold ml-2 w-100"><?php echo e($event->name); ?></span>
            <span class="ml-2"><?php echo e($event->current_cappacity); ?>/<?php echo e($event->capacity); ?>

            </span>
            <p class="small mt-3 p-3" style="margin-left: 150px; background-color: #efefef; border-radius: 3px;"><?php echo e(\Illuminate\Support\Str::words($event->description,80,' ...')); ?>

            <a href='<?php echo e(asset('/event/'.$event->id)); ?>' style="color: red;" ><br>Continue Reading <span>&#187;</span></a>
            </p>
        </li>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>
<?php echo $events->links(); ?>

<?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/index/events_only.blade.php ENDPATH**/ ?>