<?php if( count($errors) > 0 ): ?>
	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="alert alert-danger">
			Error : <?php echo e($error); ?>

		</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH /home/sarobidy/Documents/GitHub/Sys_Info/resources/views/inc/errors.blade.php ENDPATH**/ ?>