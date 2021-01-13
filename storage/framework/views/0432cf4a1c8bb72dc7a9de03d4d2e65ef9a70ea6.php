<div>
    <?php if(session()->has('message')): ?>
        <?php echo e($slot); ?>

        <div class="py-4 px-2 bg-green-300"><?php echo e(session()->get('message')); ?></div>
    <?php elseif(session()->has('error')): ?>
        <?php echo e($slot); ?>

        <div class="py-4 px-2 bg-red-300"><?php echo e(session()->get('error')); ?></div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="py-4 px-2 bg-red-300">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
</div><div>
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
</div>
<?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/components/alert.blade.php ENDPATH**/ ?>