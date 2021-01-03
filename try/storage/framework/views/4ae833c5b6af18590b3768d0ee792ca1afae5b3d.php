<div class="container">
    <h3 class="text-center my-4">Exchange #<?php echo e($exchange->id); ?></h3>
    <div class="row">
        <div class="col mr-2 border px-5 text-center">
            <h4>User offer</h4>
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
            <div class="row justify-content-center">
                <div class="movie-stars" id="form_rating_movie">
                    <form action="/exchange/rate/" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="exchange_id" value="<?php echo e($exchange->id); ?>"/>
                        <input type="hidden" name="num" value="1">
                        <?php for($i = 5;$i >= 1;$i--): ?>
                            <?php if($i == $exchange->rating_for_first): ?>
                                <input id="star-<?php echo e($i); ?>-movie" type="radio" name="star"
                                       value="<?php echo e($i); ?>" checked/> <label for="star-<?php echo e($i); ?>-movie"></label>
                            <?php else: ?>
                                <input id="star-<?php echo e($i); ?>-movie" type="radio" name="star"
                                       value="<?php echo e($i); ?>" onchange="this.form.submit()"/> <label
                                    for="star-<?php echo e($i); ?>-movie"></label>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </form>
                </div>
            </div>
            <?php if($exchange->return1): ?>
                <p>Status: Returned</p>
            <?php else: ?>
                <p>Status: Not Returned</p>
            <?php endif; ?>

        </div>
        <div class="col mr-2 border px-5 text-center">
            <h4>My offer</h4>
            <div class="row">
                <div class="col">
                    <label><?php echo e($exchange->second_user->name); ?></label>
                </div>
                <div class="col">
            <span><?php echo e($exchange->second_user->rating_exchange); ?>

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
            <span><?php echo e($exchange->second_movie->title); ?><span><?php echo e($exchange->second_movie->rating); ?>

                <svg width="14" viewBox="0 0 16 22" class="bi bi-star" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                </svg>
              </span>
            </span>
                </div>
            </div>

            <?php if(!$exchange->return2): ?>
                <form action="/exchange/return" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" value="<?php echo e($exchange->id); ?>" name="exchange_id">
                    <p>Status: Not returned</p>
                    <input type="submit" value="Return it">
                </form>
            <?php else: ?>
                <p>Status: Returned</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Atanas\Desktop\Project\try\resources\views/view/exchange/auth_second.blade.php ENDPATH**/ ?>