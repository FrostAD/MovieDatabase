<?php $__env->startSection('body'); ?>
<div class="container">
    <h3 class="text-center my-4">ALL EXCHANGES</h3>




    <ol id="all-exchange-list" class="list-group">
        <?php echo $__env->make('index.exchanges_only', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </ol>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Atanas\Desktop\Project\try\resources\views/index/exchanges.blade.php ENDPATH**/ ?>