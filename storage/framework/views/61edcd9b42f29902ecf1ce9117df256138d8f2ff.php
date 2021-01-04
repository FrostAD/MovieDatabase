<?php $__env->startSection('body'); ?>
    <div class=" col ml-2 border">
        <h4 class="text-center">Publish offer</h4>
         <?php if (isset($component)) { $__componentOriginald4c8f106e1e33ab85c5d037c2504e2574c1b0975 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Alert::class, []); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginald4c8f106e1e33ab85c5d037c2504e2574c1b0975)): ?>
<?php $component = $__componentOriginald4c8f106e1e33ab85c5d037c2504e2574c1b0975; ?>
<?php unset($__componentOriginald4c8f106e1e33ab85c5d037c2504e2574c1b0975); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
        <form action="/exchange/create/save" method="POST">
            <?php echo csrf_field(); ?>
        <div class="form-group my-2">
            <label for="movie">Movie:</label>
            <select class="livesearch form-control" name="movie1_id"></select>
        </div>
        <div class="float-right">
            <input type="submit" value="Publish">
            <input type="submit" value="Cancel">
        </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Atanas\Desktop\Project\try\resources\views/create/exchange_create.blade.php ENDPATH**/ ?>