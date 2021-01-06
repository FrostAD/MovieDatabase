<!-- select2 multiple -->
<?php
    if (!isset($field['options'])) {
        $field['options'] = $field['model']::all();
    } else {
        $field['options'] = call_user_func($field['options'], $field['model']::query());
    }

    //build option keys array to use with Select All in javascript.
    $model_instance = new $field['model'];
    $options_ids_array = $field['options']->pluck($model_instance->getKeyName())->toArray();

    $field['multiple'] = $field['multiple'] ?? true;
?>

<?php echo $__env->make('crud::fields.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <label><?php echo $field['label']; ?></label>
    <?php echo $__env->make('crud::fields.inc.translatable_icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <select
        name="<?php echo e($field['name']); ?>[]"
        style="width: 100%"
        data-init-function="bpFieldInitSelect2MultipleElement"
        data-select-all="<?php echo e(var_export($field['select_all'] ?? false)); ?>"
        data-options-for-js="<?php echo e(json_encode(array_values($options_ids_array))); ?>"
        <?php echo $__env->make('crud::fields.inc.attributes', ['default_class' =>  'form-control select2_multiple'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo e($field['multiple'] ? 'multiple' : ''); ?>>

        <?php if(isset($field['allows_null']) && $field['allows_null']==true): ?>
            <option value="">-</option>
        <?php endif; ?>

        <?php if(isset($field['model'])): ?>
            <?php $__currentLoopData = $field['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if( (old(square_brackets_to_dots($field["name"])) && in_array($option->getKey(), old($field["name"]))) || (is_null(old(square_brackets_to_dots($field["name"]))) && isset($field['value']) && in_array($option->getKey(), $field['value']->pluck($option->getKeyName(), $option->getKeyName())->toArray()))): ?>
                    <option value="<?php echo e($option->getKey()); ?>" selected><?php echo e($option->{$field['attribute']}); ?></option>
                <?php else: ?>
                    <option value="<?php echo e($option->getKey()); ?>"><?php echo e($option->{$field['attribute']}); ?></option>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </select>

    <?php if(isset($field['select_all']) && $field['select_all']): ?>
        <a class="btn btn-xs btn-default select_all" style="margin-top: 5px;"><i class="la la-check-square-o"></i> <?php echo e(trans('backpack::crud.select_all')); ?></a>
        <a class="btn btn-xs btn-default clear" style="margin-top: 5px;"><i class="la la-times"></i> <?php echo e(trans('backpack::crud.clear')); ?></a>
    <?php endif; ?>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
<?php echo $__env->make('crud::fields.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>





<?php if($crud->fieldTypeNotLoaded($field)): ?>
    <?php
        $crud->markFieldTypeAsLoaded($field);
    ?>

    
    <?php $__env->startPush('crud_fields_styles'); ?>
        <!-- include select2 css-->
        <link href="<?php echo e(asset('packages/select2/dist/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <?php $__env->stopPush(); ?>

    
    <?php $__env->startPush('crud_fields_scripts'); ?>
        <!-- include select2 js-->
        <script src="<?php echo e(asset('packages/select2/dist/js/select2.full.min.js')); ?>"></script>
        <?php if(app()->getLocale() !== 'en'): ?>
        <script src="<?php echo e(asset('packages/select2/dist/js/i18n/' . app()->getLocale() . '.js')); ?>"></script>
        <?php endif; ?>
        <script>
            function bpFieldInitSelect2MultipleElement(element) {

                var $select_all = element.attr('data-select-all');
                if (!element.hasClass("select2-hidden-accessible"))
                    {
                        var $obj = element.select2({
                            theme: "bootstrap"
                        });

                        //get options ids stored in the field.
                        var options = JSON.parse(element.attr('data-options-for-js'));

                        if($select_all) {
                            element.parent().find('.clear').on("click", function () {
                                $obj.val([]).trigger("change");
                            });
                            element.parent().find('.select_all').on("click", function () {
                                $obj.val(options).trigger("change");
                            });
                        }
                    }
            }
        </script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>


<?php /**PATH C:\Users\rstoi\Documents\GitHub\MovieDatabase\vendor\backpack\crud\src\resources\views\crud/fields/select2_multiple.blade.php ENDPATH**/ ?>