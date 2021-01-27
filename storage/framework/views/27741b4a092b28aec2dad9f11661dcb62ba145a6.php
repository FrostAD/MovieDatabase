<?php $__env->startSection('body'); ?>
    <?php if(auth()->guard()->check()): ?>
        <?php if($exchange->first_user->id == \Illuminate\Support\Facades\Auth::user()->id): ?>
            <?php if($exchange->second_user): ?>
                <?php echo $__env->make('view.exchange.auth_first_second_no_ret',$exchange, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('view.exchange.auth_first_no_second_no_ret',$exchange, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php elseif($exchange->second_user): ?>
            <?php if($exchange->second_user->id == \Illuminate\Support\Facades\Auth::user()->id): ?>
                <?php echo $__env->make('view.exchange.auth_second',$exchange, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php else: ?>
            <?php echo $__env->make('view.exchange.viewer',$exchange, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(auth()->guard()->guest()): ?>
        <?php echo $__env->make('view.exchange.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/view/exchange.blade.php ENDPATH**/ ?>