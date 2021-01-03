<?php $__env->startSection('body'); ?>
<div class="container">
    <h3 class="text-center my-4">ALL MOVIES</h3>
    <div class="form-group sortBy">
         <input type="hidden" id="sorting" value="" />
        <label for="sortBy">Sort By:</label>
            <select class="form-control" id="sortType" name="sortType">
                <option value="title">Name</option>
                <option value="published">Year</option>
                <option value="rating">Rating</option>
                <option value="created_at">Last added</option>
            </select>
    </div>
    <div id="moviesTable">
    <?php echo $__env->make('index.movies_only', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Atanas\Desktop\Project\try\resources\views/index/movies.blade.php ENDPATH**/ ?>