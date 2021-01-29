<?php $__env->startSection('body'); ?>
<div class="container mt-5 text-center">
  <h2><?php echo e($festival->name); ?></h2>
  <div class="row festival-info h4">
    <div class="col-md-4">Date:<br /> <span id="festival-date" class="font-weight-bold"><?php echo e($festival->date->format('m/d/Y')); ?></span>
    </div>
    <div class="col-md-4">Where: <br /> <span id="festival-location" class="font-weight-bold"><?php echo e($festival->location); ?></span>
    </div>
    <div class="col-md-4">From: <br /><span id="festival-from" class="font-weight-bold"><?php echo e($festival->founded); ?></span></div>
  </div>
  <img class="current-festival-image" src="<?php echo e(asset('storage/'. $festival->image)); ?>" width="100%" alt="Festival image" />
  <p class="festival-bio"><?php echo e($festival->description); ?>

  </p>
</div>

      
        
          
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/view/festival.blade.php ENDPATH**/ ?>