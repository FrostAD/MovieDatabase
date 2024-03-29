
<?php
    $column['escaped'] = $column['escaped'] ?? true;
    $column['limit'] = $column['limit'] ?? 40;
    $column['attribute'] = $column['attribute'] ?? (new $column['model'])->identifiableAttribute();

    $results = data_get($entry, $column['name']);
    $results_array = [];

    if(!$results->isEmpty()) {
        $related_key = $results->first()->getKeyName();
        $results_array = $results->pluck($column['attribute'], $related_key)->toArray();
    }

    foreach ($results_array as $key => $text) { 
        $results_array[$key] = Str::limit($text, $column['limit'], '[...]');
    }
?>

<span>
    <?php if(!empty($results_array)): ?>
        <?php $__currentLoopData = $results_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $related_key = $key;
            ?>

            <span class="d-inline-flex">
                <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
                    <?php if($column['escaped']): ?>
                        <?php echo e($text); ?>

                    <?php else: ?>
                        <?php echo $text; ?>

                    <?php endif; ?>
                <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

                <?php if(!$loop->last): ?>, <?php endif; ?>
            </span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        -
    <?php endif; ?>
</span><?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\vendor\backpack\crud\src\resources\views\crud/columns/select_multiple.blade.php ENDPATH**/ ?>