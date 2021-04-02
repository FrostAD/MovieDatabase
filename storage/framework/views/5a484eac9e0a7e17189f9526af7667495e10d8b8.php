<?php $__env->startSection('body'); ?>
    <div class="container">
        <div class="row mt-5">
            <div class="current-event col-8">
                <h3 class="ml-md-5"><?php echo e($event->name); ?></h3>
            </div>
            <div class="col-3">
                <h4 class="status-event float-right">
                    Status:
                    <!-- Class active has to be only on one of them -->
                    <!-- if user is signed for the event -> fa-check -->
                    <!-- if user isn't signed for the event -> fa-times -->
                    <a href="">
                        <?php if($event->users->contains(App\Models\User::find(\Illuminate\Support\Facades\Auth::id()))||$event->user->id == \Illuminate\Support\Facades\Auth::id()): ?>
                            <i class="fa fa-check active" aria-hidden="true"></i>
                        <?php else: ?>
                            <i class="fa fa-times " aria-hidden="true"></i>
                        <?php endif; ?>
                    </a>
                </h4>
            </div>
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
        </div>
        <div class="row mt-4">
            <div class="col-4">
                <div id="movie-card" class="card">
                    <img src="<?php echo e(asset('storage/'. $movie->poster)); ?>" style="height: 40vh" alt="Event's movie poster">
                    <div class="p-3">
                        <h3 class="card-title"><?php echo e($movie->title); ?></h3>
                        <ul class="movie-concise-info">
                            <li class="movie-year"><?php echo e($movie->published->format('m/d/Y')); ?></li>
                            <li class="movie-time"><?php echo e($movie->timespan); ?></li>
                            <li class="movie-genre">
                                <?php $__currentLoopData = $movie->genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($genre->name . ', '); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </li>
                        </ul>
                        <p id="movie-card-description" class="scrollbar-hidden"><?php echo e($movie->description); ?></p>
                        <div class="watch-btn">
                            <a href="<?php echo e($movie->trailer); ?>">
                                <button type="button" class="btn btn-primary"><i
                                        class="fa fa-play mr-2"></i>WATCH TRAILER
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="row h4 text-center">
                    <div class="col-md-6">Date:<br/> <span id="event-date"
                                                           class="font-weight-bold"><?php echo e($event->date->format('m/d/Y')); ?></span>
                    </div>
                    <div class="col-md-6">Where: <br/> <span id="event-location"
                                                             class="font-weight-bold"><?php echo e($event->location); ?></span>
                    </div>
                </div>
                <div class="row">
                    <p id="event-description" class="scrollbar-hidden"><?php echo e($event->description); ?></p>
                </div>
                <?php if(auth()->guard()->guest()): ?>
                    <div class="row d-flex flex-column justify-content-end">
                        <p>Please login to be able to sign in for this event.</p>
                        <form action="/login">
                            <input type="submit" value="Login">
                        </form>
                    </div>
                <?php endif; ?>
                <?php if(auth()->guard()->check()): ?>
                    <?php if($event->current_cappacity == $event->capacity && !$event->users->contains(\Illuminate\Support\Facades\Auth::user()->id)): ?>
                        <div class="row d-flex flex-column justify-content-end"><p>No available places</p></div>
                    <?php else: ?>
                        <div class="row d-flex flex-column justify-content-end">
                            <?php if(\Illuminate\Support\Facades\Auth::user()->id == $event->user_id): ?>
                                <form action="/event/cancel" method="POST">
                                    <?php else: ?>
                                        <form action="/event/join" method="POST">
                                            <?php endif; ?>
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" value="<?php echo e($event->id); ?>" name="event_id">
                                            <?php if($event->users->contains(\Illuminate\Support\Facades\Auth::user()->id) || $event->user->id == \Illuminate\Support\Facades\Auth::id()): ?>
                                                <input type="hidden" value="q" name="type">
                                                <?php if(\Illuminate\Support\Facades\Auth::user()->id == $event->user_id): ?>
                                                    <button class="btn btn-primary position-absolute" type="submit"
                                                            style="bottom: 0; right: 0;">Cancel event
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-primary position-absolute" type="submit"
                                                            style="bottom: 0; right: 0;">Leave
                                                    </button>
                                                <?php endif; ?>

                                            <?php else: ?>
                                                <input type="hidden" value="e" name="type">
                                                <button class="btn btn-primary position-absolute" type="submit"
                                                        style="bottom: 0; right: 0;">Join
                                                </button>
                                            <?php endif; ?>
                                        </form>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="row d-flex flex-column justify-content-end">
                    <p>Current capacity: <?php echo e($event->current_cappacity); ?>/<?php echo e($event->capacity); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/view/event.blade.php ENDPATH**/ ?>