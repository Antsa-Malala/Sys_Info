<?php $__env->startSection('content'); ?>
	<div class="container">
    <div class="title row">
        <div class="title">
            <h2 class="text-center text-decoration-underline">
                Liste de vos Comptes Tiers
            </h2>
        </div>
    </div>
    <a href="<?php echo e(url('/tiers-insertion')); ?>" class="btn btn-primary">
        Ajouter
    </a>
    
    <table class="table">
        <tr>
        <th>Numero de compte</th>
        <th>Libelle</th>
        </tr>
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($plan->numero); ?></td>
            <td><?php echo e($plan->libelle); ?></td>
            <td><a href="<?php echo e(url('/tiers-delete/'.$plan->idtiers)); ?>" class="btn btn-danger">Supprimer</a></td>
            <td><a class="btn btn-primary px-3" href="<?php echo e(url('/tiers-update_tiers/'.$plan->idtiers)); ?>" btn>Modifier</a></td>

        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    
    
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarobidy/Documents/GitHub/Sys_Info/resources/views/pages/tiers/index.blade.php ENDPATH**/ ?>