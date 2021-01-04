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
            <div class="mt-3 p-3" style="margin-left: 150px; background-color: #efefef; border-radius: 3px;">
                <p class="small"><?php echo e($festival->description); ?>

                </p>
            </div>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>
<?php echo $festivals->links(); ?>

<?php /**PATH C:\Users\Atanas\Desktop\Project\try\resources\views/index/festivals_only.blade.php ENDPATH**/ ?>