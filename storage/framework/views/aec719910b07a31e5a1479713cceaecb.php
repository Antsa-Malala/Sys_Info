<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="<?php echo e(URL::asset('bootstrap/bootstrap-5.0.2/css/bootstrap.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(URL::asset('aos/dist/aos.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/home.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/error.css')); ?>">
	<script src="<?php echo e(URL::asset('js/jquery.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(URL::asset('js/parsley.min.js')); ?>"></script>
	<title><?php echo e($title); ?></title>
</head>
<style>
	* {
	    padding: 0;
    	margin: 0;
	}

	html {
		position: relative;
		min-height: 100%;
	}

	body {
		/* Margin bottom by footer height */
		margin-bottom: 60px;
	}

	.footer {
		position: absolute;
		bottom: 0;
		width: 100%;
		/* Set the fixed height of the footer here */
		height: 60px;
	}
</style>
<body>
	<?php echo $__env->make('inc.headers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->yieldContent('content'); ?>
	<?php echo $__env->make('inc.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	
	<script type="text/javascript" src="<?php echo e(URL::asset('bootstrap/bootstrap-5.0.2/js/bootstrap.min.js')); ?>"></script>
	<script>
  		$('#form').parsley();
	</script>
	
</body>
</html><?php /**PATH /home/sarobidy/Documents/GitHub/Sys_Info/resources/views/layouts/app.blade.php ENDPATH**/ ?>