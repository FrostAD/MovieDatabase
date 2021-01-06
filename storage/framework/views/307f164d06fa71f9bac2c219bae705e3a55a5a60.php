

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
  <p class="festival-bio">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis autem error quasi dolor
    ipsa quae deserunt
    voluptatem aliquam expedita quo. Molestias repudiandae nemo quibusdam necessitatibus error reprehenderit nihil
    accusantium cumque consectetur id, molestiae nulla consequatur quaerat pariatur! Alias minus fugiat quasi eius
    ducimus, dolor velit quam nihil expedita ab asperiores. Lorem ipsum dolor sit amet consectetur adipisicing elit.
  </p>
</div>

      
        
          
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\rstoi\Documents\GitHub\MovieDatabase\resources\views/view/festival.blade.php ENDPATH**/ ?>