<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="container">
        <div class="container">
                <form id="formulaire_recherche" class="form" action="<?php echo e(url('/search_journal')); ?>" method="GET">
                    <div class="mb-3">
                        <input type="text" class="form-control" onkeyup="fetchData(this)" name="recherche" placeholder="Rechercher code journal">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>

                <div id="resultats">
                </div>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('js/search_journal.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarobidy/Documents/GitHub/Sys_Info/resources/views/pages/codes/recherche.blade.php ENDPATH**/ ?>