
<?php if($crud->hasAccess('update')): ?>
    <a href="<?php echo e(url($crud->route.'/'.$entry->getKey().'/restore')); ?> " class="btn btn-sm btn-link"><i class="la la-fast-backward
"></i> Restore</a>
<?php endif; ?>
<?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/vendor/backpack/crud/buttons/restore.blade.php ENDPATH**/ ?>