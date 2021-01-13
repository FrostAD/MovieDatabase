<?php $__env->startSection('body'); ?>
<div class="container">
    <form id="add-event-form" action="/event/create/save" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group my-2">
            <div class="row">
                <div class="col">
                    <label for="event-name">Event Name:</label>
                    <input class="form-control" type="text" name="name">
                </div>
                <div class="col">
                    <label for="event-date">Date</label>
                    <input class="form-control" id="datepicker" name="date" type="date" autocomplete="off" />
                </div>
                <div class="col">
                    <label for="seating">Seating:</label>
                    <input class="form-control" id="seating" name="capacity" type="number" />
                </div>
            </div>
        </div>
        <div class="form-group my-2">
            <label for="event-location">Event Location:</label>
            <input class="form-control" type="text" name="location">
        </div>
        <div class="form-group my-2">
            <label for="movie">Movie:</label>
            <select class="livesearch form-control" name="movie_id"></select>
        </div>
        <div class="form-group my-2">
            <label for="event-info">Bio:</label>
            <textarea class="form-control" rows="5" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/create/event_create.blade.php ENDPATH**/ ?>