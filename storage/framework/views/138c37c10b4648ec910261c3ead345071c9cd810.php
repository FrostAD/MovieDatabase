<ol id="all-festivals-list" class="list-group">
    <?php echo csrf_field(); ?>
    <?php $__currentLoopData = $festivals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $festival): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="list-group-item">
            <a href='/festival/<?php echo e($festival->id); ?>' class="float-left">
                <img src="<?php echo e(asset('storage/' . $festival->image)); ?>">
            </a>
            <span class="font-weight-bold ml-2 w-100"><?php echo e($festival->name); ?></span>
            <span class="ml-2"><?php echo e($festival->founded); ?>

            </span>
            <p class="small mt-3 p-3" style="margin-left: 150px; background-color: #efefef; border-radius: 3px;"><?php echo e(\Illuminate\Support\Str::words($festival->description,80,' ...')); ?><a href='<?php echo e(asset('/festival/'.$festival->id)); ?>' style="color: red;" ><br>Continue Reading <span>&#187;</span></a>
            </p>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>
<?php echo $festivals->links(); ?>

<?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/index/festivals_only.blade.php ENDPATH**/ ?>