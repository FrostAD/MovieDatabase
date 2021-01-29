<?php $__env->startSection('body'); ?>
    <div class="container">
        <div class="row mt-5">
            <div class="current-movie col-md-8">
                <h3><?php echo e($movie->title); ?></h3>
                <ul class="movie-concise-info">
                    <li class="movie-year"><?php echo e($movie->published->format('m/d/Y')); ?></li>
                    <li class="movie-time"><?php echo e($movie->timespan); ?></li>
                    <li class="movie-genre">
                        <?php $__currentLoopData = $movie->genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($genre->name . ', '); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4 class="float-right">
                    <small>IMDB: <?php echo e($movie->rating_imbd); ?> </small><span><svg width="16" viewBox="0 0 16 20"
                                                                            class="bi bi-star" fill="currentColor"
                                                                            xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
            </svg>
          </span>
                    |
                    <small>OUR: <?php echo e($movie->rating); ?> </small><span><svg width="16" viewBox="0 0 16 20" class="bi bi-star"
                                                                      fill="currentColor"
                                                                      xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
            </svg>
          </span>
                </h4>
            </div>
            <!-- Share movie -->
            <div class="col-md-1 d-flex">
                <a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="d-flex my-auto pl-3">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->watchlist->contains($movie)): ?>
                        <form action="/movie/watchlist_remove" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($movie->id); ?>" name="movie_id">
                            <button type="submit" class="btn btn-danger btn-sm mr-2" title="Remove from watchlist">
                                Watchlist
                            </button>
                        </form>
                    <?php else: ?>
                        <form action="/movie/watchlist_add" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($movie->id); ?>" name="movie_id">
                            <button type="submit" class="btn btn-success btn-sm mr-2" title="Add to watchlist">
                                Watchlist
                            </button>
                        </form>
                    <?php endif; ?>
                    <?php if(auth()->user()->wishlist->contains($movie)): ?>
                        <form action="/movie/wishlist_remove" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($movie->id); ?>" name="movie_id">
                            <button type="submit" class="btn btn-danger btn-sm" title="Remove from wishlist">Wishlist
                            </button>
                        </form>
                    <?php else: ?>
                        <form action="/movie/wishlist_add" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($movie->id); ?>" name="movie_id">
                            <button type="submit" class="btn btn-success btn-sm" title="Add to wishlist">Wishlist
                            </button>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="movie-stars d-flex ml-auto" id="form_rating_movie">
                <h5 class="my-auto">Rate this movie: </h5>
                <form action="/movie/rate/" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="movie_id" value="<?php echo e($movie->id); ?>"/>
                    <?php for($i = 5;$i >= 1;$i--): ?>
                        <?php if($i == $movie->userAverageRating): ?>
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
        <div class="row h-100" style="overflow: hidden;">
            <div class="col-md-3 img-current-movie" style="">
                <img style="min-width: 100%" src="<?php echo e(asset('storage/' . $movie->poster)); ?>"/>
            </div>
            <div class="col-md-9 trailer-current-movie ml-auto" style="">
                <iframe class="h-100 w-100" frameBorder="0" src="<?php echo e($url); ?>"></iframe>
            </div>
        </div>
        <div class="row description my-3 p-3">
            <p><?php echo e($movie->description); ?></p>
        </div>
        
        
        <?php $__currentLoopData = $movie->producers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a class="list-group-item list-group-item-action" data-toggle="list"
                   href="#producer<?php echo e($producer->id); ?>"><?php echo e($producer->name); ?></a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $movie->musicians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $musician): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a class="list-group-item list-group-item-action" data-toggle="list"
                   href="#musician<?php echo e($musician->id); ?>"><?php echo e($musician->name); ?></a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $movie->screenwritters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screenwritter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a class="list-group-item list-group-item-action" data-toggle="list"
                   href="#screenwritter<?php echo e($screenwritter->id); ?>"><?php echo e($screenwritter->name); ?></a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $movie->studios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a class="list-group-item list-group-item-action" data-toggle="list"
                   href="#studio<?php echo e($studio->id); ?>"><?php echo e($studio->name); ?></a>
            </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <!-- Actors -->
        <div class="row actors-menu">
            <div class="col-4 actors-name scrollbar-hidden">
                <ul class="list-group actors-menu">
                    <?php $__currentLoopData = $movie->actors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a class="list-group-item list-group-item-action" data-toggle="list"
                               href="#actor<?php echo e($actor->id); ?>"><?php echo e($actor->name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <div class="col tab-content scrollbar-hidden">
                <?php $__currentLoopData = $movie->actors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->first): ?>
                        <div class="tab-pane fade show active" id="actor<?php echo e($actor->id); ?>">
                            <div class="float-left" style="height: 250px;">
                                <a href="/actor/<?php echo e($actor->id); ?>">
                                    <img class="h-100" src="<?php echo e(asset('storage/'.$actor->image)); ?>" width="150px"
                                         style="float: left;"
                                         alt="">
                                </a>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Name</label>
                                </div>
                                <div class="col">
                                    <p><?php echo e($actor->name); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Born</label>
                                </div>
                                <div class="col">
                                    <p><?php echo e($actor->born_place); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Year</label>
                                </div>
                                <div class="col">
                                    <p><?php echo e($actor->born_date->format('m/d/Y')); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="tab-pane fade h-100" id="actor<?php echo e($actor->id); ?>">
                        <a href="/actor/<?php echo e($actor->id); ?>">
                            <img class="h-100" src="<?php echo e(asset('storage/'.$actor->image)); ?>" width="150"
                                 style="float: left;">
                        </a>
                        <div class="row">
                            <div class="col">
                                <label>Name</label>
                            </div>
                            <div class="col">
                                <p><?php echo e($actor->name); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Born</label>
                            </div>
                            <div class="col">
                                <p><?php echo e($actor->born_place); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Year</label>
                            </div>
                            <div class="col">
                                <p><?php echo e($actor->born_date->format('m/d/Y')); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <!-- End Actors -->
        <!-- Post Raiting -->
        <div class="row">
            <div class="post-stars d-flex mx-auto">
                <h5 class="my-auto">Rate this post: </h5>
                <form action="/movie/rate/post" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="movie_id" value="<?php echo e($movie->id); ?>"/>
                    <?php for($i = 5;$i >= 1;$i--): ?>
                        <?php if($i == $post->rating): ?>
                            <input id="star-<?php echo e($i); ?>-post" type="radio" name="star"
                                   value="<?php echo e($i); ?>" checked/> <label for="star-<?php echo e($i); ?>-post"></label>
                        <?php else: ?>
                            <input id="star-<?php echo e($i); ?>-post" type="radio" name="star"
                                   value="<?php echo e($i); ?>" onchange="this.form.submit()"/> <label for="star-<?php echo e($i); ?>-post"></label>
                        <?php endif; ?>
                    <?php endfor; ?>
                </form>
            </div>
        </div>
        <!-- Published by -->
        <div class="row d-block">
            <h3>Published by</h3>
            <div class="d-flex" style="height: 150px">
                <img src="<?php echo e(asset('storage/avatars/'.$movie->user->avatar)); ?>" class="h-100 ml-3" alt="">
                <p><?php echo e($movie->user->name . ", " . $movie->user->rating_post); ?></p>
            </div>
        </div>
        <!-- People also watch -->
        <div class="row">
            <div class="col-6">
                <h3>People also watch:</h3>
                <div class="selector-page scrollbar-hidden">
                    <ul>
                        <?php $__currentLoopData = $recommended; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href=""><img src="<?php echo e(asset('storage/'.$m->poster)); ?>" alt=""></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <!-- TODO --- TODO --- TODO -->
            <div class="col-6 m-auto">
                <p>Some events (work in progress)</p>
                <ul>
                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="/event/<?php echo e($event->id); ?>"><?php echo e($event->name); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($events->links()); ?>

                </ul>
                <p>Available exchanges: <a href="/exchanges/<?php echo e($movie->id); ?>"><?php echo e($exchanges); ?></a></p>
            </div>
        </div>
        <!-- Add Comment -->
        <form action="/comment/store" method="POST">
            <?php echo csrf_field(); ?>
            <div id="add-comment" class="form-group">
                <input type="hidden" value="<?php echo e($movie->id); ?>" name="movie_id">
                <textarea class="form-control" rows="5" placeholder="Write your comment..."
                          name="description"></textarea>
            </div>
            <div class="mt-2 text-right">
                <button class="btn-primary btn" type="submit"> Post comment</button>
            </div>
        </form>

        <div id="table_data">
            <h5>Display Comments</h5>

            <?php echo $__env->make('partials.custom_replies', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/view/movie2.blade.php ENDPATH**/ ?>