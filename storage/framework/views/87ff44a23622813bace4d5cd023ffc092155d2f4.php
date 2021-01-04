<?php $__env->startSection('body'); ?>
    <div class="container mt-3 p-4">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="<?php echo e(asset('storage/'. $screenwritter->image)); ?>" alt="" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        <?php echo e($screenwritter->name); ?>

                    </h5>
                    <p class="small">Actor</p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                               aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                               aria-selected="false">List</a>
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
                                        <p><?php echo e($screenwritter->name); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Born</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo e($screenwritter->born_place); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Date</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo e($screenwritter->born_date); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Biography</label>
                                        <p><?php echo e($screenwritter->description); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php echo csrf_field(); ?>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <?php echo $__env->make('view.actor_movies', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Atanas\Desktop\Project\try\resources\views/view/screenwritter.blade.php ENDPATH**/ ?>