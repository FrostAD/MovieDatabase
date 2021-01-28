<?php $__currentLoopData = $exchanges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exchange): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(!($exchange->first_user == null && $exchange->second_user == null)): ?>
    <li class="list-group-item">
        <a href="/movie/<?php echo e($exchange->first_movie->id); ?>" class="float-left">
            <img src="<?php echo e(asset('storage/'. $exchange->first_movie->poster)); ?>">
        </a>
        <span class="font-weight-bold ml-2 w-100"><?php echo e($exchange->first_movie->title); ?></span>
        <span class="ml-2"><?php echo e($exchange->first_movie->rating); ?>

          <svg width="14" viewBox="0 0 16 22" class="bi bi-star" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
          </svg>
        </span>
        <a href="/exchange/<?php echo e($exchange->id); ?>">
            <button class="btn btn-secondary float-right">View</button>
        </a>
        <div class="mt-3 p-3" style="margin-left: 150px; background-color: #efefef; border-radius: 3px;">
            <p class="small">Offer from <?php echo e($exchange->first_user->name); ?> <svg width="14" viewBox="0 0 16 22" class="bi bi-star" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                </svg> <?php echo e($exchange->first_user->rating_exchange); ?>

            </p>
        </div>
    </li>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo e($exchanges->links()); ?>

<?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/index/exchanges_only.blade.php ENDPATH**/ ?>