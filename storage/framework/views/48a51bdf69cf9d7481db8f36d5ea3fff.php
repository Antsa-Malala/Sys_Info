
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="container">
        <form action="/plan-update" method="POST" id="form">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="idplan"  value="<?php echo e($compte->idplan); ?>">
            <div class="my-3">
                <label for="compte" class="form-label">Numero de compte</label>
                <input type="text" name="compte" class="form-control my-2" id="compte" value="<?php echo e($compte->compte); ?>"
                required data-parsley-type="number" maxlength="5" min="1">
            </div>
            <div class="my-3">
                <label class="form-label" for="libelle">Libelle </label>
                <input type="text" class="form-control my-2" name="libelle" id="libelle" value="<?php echo e($compte->libelle); ?>" required>
                
            </div>
            <div class="mb-3">
                <input type="submit" value="Modifier" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarobidy/Documents/GitHub/Sys_Info/resources/views/pages/plan/update_plan.blade.php ENDPATH**/ ?>