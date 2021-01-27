<div class="container">
    <h3 class="text-center my-4">Exchange #<?php echo e($exchange->id); ?></h3>
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
    <div class="row">
        <div class="col mr-2 border px-5 text-center">
            <h4>My offer</h4>
            <div class="row">
                <div class="col">
                    <label><?php echo e($exchange->first_user->name); ?></label>
                </div>
                <div class="col">
            <span><?php echo e($exchange->first_user->rating_exchange); ?>

              <svg width="14" viewBox="0 0 16 22" class="bi bi-star" fill="currentColor"
                   xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
              </svg>
            </span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Offers</label>
                </div>
                <div class="col">
            <span><?php echo e($exchange->first_movie->title); ?><span><?php echo e($exchange->first_movie->rating); ?>

                <svg width="14" viewBox="0 0 16 22" class="bi bi-star" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                </svg>
              </span>
            </span>
                </div>
            </div>
            <form action="/exchange/cancel" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" value="<?php echo e($exchange->id); ?>" name="exchange_id">
                <input type="submit" value="Cancel exchange">
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/view/exchange/auth_first_no_second_no_ret.blade.php ENDPATH**/ ?>