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
        </div>
        <div class="row mt-4">
            <div class="col-4">
                <div id="movie-card" class="card">
                    <img src="<?php echo e(asset('storage/'. $movie->poster)); ?>" class="" style="height: 250px" alt="">
                    <div class="p-3">
                        <h3 class="card-title"><?php echo e($movie->title); ?></h3>
                        <ul class="movie-concise-info">
                            <li class="movie-year"><?php echo e($movie->published); ?></li>
                            <li class="movie-time"><?php echo e($movie->timespan); ?></li>
                            <li class="movie-genre">
                                <?php $__currentLoopData = $movie->genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($genre->name . ', '); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </li>
                        </ul>
                        <p><?php echo e($movie->description); ?></p>
                        
                        
                        
                        
                        
                        
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="row h4 text-center">
                    <div class="col-md-6">Date:<br/> <span id="event-date"
                                                           class="font-weight-bold"><?php echo e($event->date); ?></span>
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
                    <?php if($event->current_cappacity == $event->capacity): ?>
                        <div class="row d-flex flex-column justify-content-end"><p>No available places</p></div>
                    <?php else: ?>
                        <div class="row d-flex flex-column justify-content-end">
                            <form action="/event/join" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" value="<?php echo e($event->id); ?>" name="event_id">
                                <?php if($event->users->contains(\Illuminate\Support\Facades\Auth::user()->id) || $event->user->id == \Illuminate\Support\Facades\Auth::id()): ?>
                                    <input type="hidden" value="q" name="type">
                                    <?php if(\Illuminate\Support\Facades\Auth::user()->id == $event->user_id): ?>

                                        <button class="btn btn-primary position-absolute" type="submit" style="bottom: 0; right: 0;">Cancel event</button>
                                    <?php else: ?>

                                        <button class="btn btn-primary position-absolute" type="submit" style="bottom: 0; right: 0;">Leave</button>
                                    <?php endif; ?>

                                <?php else: ?>
                                    <input type="hidden" value="e" name="type">

                                    <button class="btn btn-primary position-absolute" type="submit" style="bottom: 0; right: 0;">Sign
                                        up</button>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Atanas\Desktop\Project\try\resources\views/view/event.blade.php ENDPATH**/ ?>