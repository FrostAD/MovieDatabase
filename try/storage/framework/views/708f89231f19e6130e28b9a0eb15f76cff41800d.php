
<?php
    $value = data_get($entry, $column['name']);

    $column['escaped'] = $column['escaped'] ?? true;
    $column['text'] = empty($value) ? '' : \Carbon\Carbon::parse($value)
                    ->locale(App::getLocale())
                    ->isoFormat($column['format'] ?? config('backpack.base.default_date_format'));
?>

<span data-order="<?php echo e($value ?? ''); ?>">
	<?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
        <?php if($column['escaped']): ?>
            <?php echo e($column['text']); ?>

        <?php else: ?>
            <?php echo $column['text']; ?>

        <?php endif; ?>
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
</span>
<?php /**PATH C:\Users\Atanas\Desktop\Project\try\vendor\backpack\crud\src\resources\views\crud/columns/date.blade.php ENDPATH**/ ?>