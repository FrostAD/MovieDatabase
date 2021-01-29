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

                    </h5>
                    <p>Rating : <span><?php echo e($user->rating_overall); ?></span></p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home"
                               aria-selected="true">About</a>
                        </li>
                        <?php if(auth()->guard()->check()): ?>
                            <?php if($user->movies->isNotEmpty()): ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile_posts"
                                       role="tab"
                                       aria-controls="profile"
                                       aria-selected="false">Posts</a>
                                </li>
                            <?php endif; ?>
                                <?php if(\Illuminate\Support\Facades\Auth::id() == $user->id): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile_exchanges"
                                           role="tab"
                                           aria-controls="profile"
                                           aria-selected="false">My exchanges</a>
                                    </li>
                                <?php endif; ?>
                        <?php endif; ?>
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
                            
                                <?php if(auth()->guard()->check()): ?>
                                    <?php if($user->movies->isNotEmpty()): ?>
                                        <div class="tab-pane fade" id="profile_posts" role="tabpanel"
                                             aria-labelledby="profile-tab">
                                            <ul class="list-group">
                                                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="list-group-item"><a
                                                            href="/movie/<?php echo e($post->id); ?>"><?php echo e($post->title); ?></a></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php echo e($posts->links()); ?>

                                        </div>
                                    <?php endif; ?>
                                        <?php if(\Illuminate\Support\Facades\Auth::id() == $user->id): ?>
                                            <div class="tab-pane fade" id="profile_exchanges" role="tabpanel"
                                                 aria-labelledby="profile-tab">
                                                <ul class="list-group">
                                                    <?php $__currentLoopData = $exchanges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exchange): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="list-group-item"><a
                                                                href="/exchange/<?php echo e($exchange->id); ?>">Exchange <?php echo e($exchange->id); ?></a></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                                <?php echo e($posts->links()); ?>

                                            </div>
                                        <?php endif; ?>
                                <?php endif; ?>
                            <div class="tab-pane fade" id="profile_wishlist" role="tabpanel" aria-labelledby="profile-tab">
                                <ul class="list-group">
                                    <?php $__currentLoopData = $wishlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item"><a href="/movie/<?php echo e($m->id); ?>"><?php echo e($m->title); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <?php echo e($wishlist->links()); ?>

                            </div>
                            <div class="tab-pane fade" id="profile_watchlist" role="tabpanel" aria-labelledby="profile-tab">
                                <ul class="list-group">
                                <?php $__currentLoopData = $watchlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item"><a href="/movie/<?php echo e($m->id); ?>"><?php echo e($m->title); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <?php echo e($watchlist->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <?php if(auth()->guard()->check()): ?>
                    <?php if($user->id == \Illuminate\Support\Facades\Auth::id()): ?>
                            <a href="<?php echo e(route('account.settings',\Illuminate\Support\Facades\Auth::id())); ?>">
                                <button class="profile-edit-btn">Edit Profile</button>
                            </a>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(auth()->check() && auth()->user()->hasRole('Admin')): ?>
                        <?php if($user->trashed()): ?>
                            <a href="/admin/user/<?php echo e($user->id); ?>/restore">
                                <button class="profile-edit-btn" type="submit">Restore</button>
                            </a>
                        <?php else: ?>
                            
                            <form action="/admin/user/<?php echo e($user->id); ?>/delete" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="profile-edit-btn btn-danger" type="submit">Deactivate</button>
                            </form>
                        <?php endif; ?>
                        <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/view/user.blade.php ENDPATH**/ ?>