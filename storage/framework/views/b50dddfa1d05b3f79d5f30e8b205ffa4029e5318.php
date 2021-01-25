
<?php $__env->startSection('body'); ?>
    <div class="container mt-3 p-4">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="<?php echo e(asset('storage/avatars/'.$user->avatar)); ?>" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        <?php echo e($user->name); ?>

                        <?php if(auth()->check() && auth()->user()->hasRole('Admin')): ?>
                        <?php if($user->trashed()): ?>
                            <a href="/admin/user/<?php echo e($user->id); ?>/restore">
                                <button type="submit">Restore</button>
                            </a>
                        <?php else: ?>
                            
                            <form action="/admin/user/<?php echo e($user->id); ?>/delete" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit">Deactivate</button>
                            </form>
                        <?php endif; ?>
                        <?php endif; ?>
                    </h5>
                    <p>Rating : <span><?php echo e($user->rating_overall); ?></span></p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home"
                               aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile"
                               aria-selected="false">List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile_wishlist" role="tab"
                               aria-controls="profile"
                               aria-selected="false">Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile_watchlist" role="tab"
                               aria-controls="profile"
                               aria-selected="false">Watchlist</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo e($user->name); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo e($user->email); ?></p>
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum nobis nihil,
                                voluptate sunt quasi
                                commodi explicabo dignissimos autem, sed eaque iusto quaerat molestias placeat. Velit
                                ipsum at aliquid
                                exercitationem ex, placeat corporis commodi inventore dolorum. Voluptas perspiciatis
                                magni tempore sequi
                                beatae expedita. Praesentium, incidunt dolorum similique facilis voluptate velit soluta!

                            </div>
                            <div class="tab-pane fade" id="profile_wishlist" role="tabpanel" aria-labelledby="profile-tab">
                                <?php $__currentLoopData = $wishlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="/movie/<?php echo e($m->id); ?>"><?php echo e($m->title); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($wishlist->links()); ?>}
                            </div>
                            <div class="tab-pane fade" id="profile_watchlist" role="tabpanel" aria-labelledby="profile-tab">
                                <?php $__currentLoopData = $watchlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="/movie/<?php echo e($m->id); ?>"><?php echo e($m->title); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($watchlist->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <a href="<?php echo e(route('account.settings',\Illuminate\Support\Facades\Auth::id())); ?>">
                    <button class="profile-edit-btn">Edit Profile</button>
                </a>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\rstoi\Documents\GitHub\MovieDatabase\resources\views/view/user.blade.php ENDPATH**/ ?>