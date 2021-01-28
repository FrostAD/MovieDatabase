<?php $__env->startSection('body'); ?>
    <div class="container">
        <h3 class="text-center my-4">ALL FESTIVALS</h3>
        <div class="form-group sortBy">
            <input type="hidden" id="sorting" value="" />
            <label for="sortBy">Sort By:</label>
            <select class="form-control" id="sortType" name="sortType">
                <option value="name">Name</option>
                <option value="founded">Founded</option>
                <option value="date">Date</option>
            </select>
        </div>
        <div id="festivalsTable">
            <?php echo $__env->make('index.festivals_only', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/index/festivals.blade.php ENDPATH**/ ?>