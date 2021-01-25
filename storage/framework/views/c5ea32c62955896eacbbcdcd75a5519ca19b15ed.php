<?php if($crud->hasAccess('update')): ?>
    <a href="<?php echo e(url($crud->route.'/'.$entry->getKey().'/hard_delete')); ?> " class="btn btn-sm btn-link"><i class="la la-trash
"></i> Hard Delete</a>
<?php endif; ?>
<?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\resources\views/vendor/backpack/crud/buttons/hard_delete.blade.php ENDPATH**/ ?>