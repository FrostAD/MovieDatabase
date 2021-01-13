
<?php
   $relationshipType = new ReflectionClass($entry->{$column['name']}());
   $relationshipType = $relationshipType->getShortName();
   $allows_multiple = $crud->guessIfFieldHasMultipleFromRelationType($relationshipType);
?>

<?php if($allows_multiple): ?>
	<?php echo $__env->make('crud::columns.select_multiple', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
	<?php echo $__env->make('crud::columns.select', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\vendor\backpack\crud\src\resources\views\crud/columns/relationship.blade.php ENDPATH**/ ?>