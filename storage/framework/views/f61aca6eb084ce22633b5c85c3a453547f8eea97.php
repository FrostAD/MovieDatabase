<?php $__env->startSection('body'); ?>
    <div class="container mt-3 p-4">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="<?php echo e(asset('storage/'. $producer->image)); ?>" alt="" />




                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        <?php echo e($producer->name); ?>

                    </h5>
                    <p class="small">Actor</p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                               aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="producer_movies" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                               aria-selected="false">Movies</a>
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
                                        <p><?php echo e($producer->name); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Born</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo e($producer->born_place); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Date</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo e($producer->born_date->format('m/d/Y')); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Biography</label>
                                        <p><?php echo e($producer->description); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php echo csrf_field(); ?>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <ul class="list-group">
                                    <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list-group-item"><a href="/movie/<?php echo e($movie->id); ?>"><?php echo e($movie->title); ?></a>  -   <?php echo e($movie->rating); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <?php echo $movies->links(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/view/producer.blade.php ENDPATH**/ ?>