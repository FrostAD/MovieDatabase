
<?php
    $value = data_get($entry, $column['name']);
    $column['text'] = is_string($value) ? $value : '';
    $column['escaped'] = $column['escaped'] ?? false;
?>

<span>
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
        <?php if($column['escaped']): ?>
            <?php echo e($column['text']); ?>

        <?php else: ?>
            <?php echo $column['text']; ?>

        <?php endif; ?>
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
</span>
<?php /**PATH C:\Users\Atanas\Desktop\Project\try\vendor\backpack\crud\src\resources\views\crud/columns/textarea.blade.php ENDPATH**/ ?>