<?php $__env->startSection('content'); ?>
	<div class="container">
		<div class="container">
			<div class="title">
				<h2 class="text-center text-decoration-underline">
					Ajouter une écriture
				</h2>
			</div>
			<form action="/testEP" method="post" class="form">
				<?php echo csrf_field(); ?>
				<div class="mb-3">
					<label for="" class="form-label">
						Libelle:
					</label>
					<input type="text" name="libelle" value="<?php echo e(old('libelle')); ?>" class="form-control" placeholder="ACHAT MARCHANDISE ROJO">
				</div>
				<div class="mb-3">
					
					<label for="" class="form-label">
						Date d'écriture:
					</label>
					<input type="date" name="date" value="<?php echo e(old('date')); ?>" id="" class="form-select">
				</div>
				<div class="my-3">
					<label for="" class="form-label">
						Choississez Un code journal
					</label>
					<select name="code" id="" class="form-select">
						<?php for($i = 0 ; $i < count($journaux) ; $i++): ?>
							<option value="<?php echo e($journaux[$i]->idcode); ?>"> <?php echo e($journaux[$i]->code); ?> </option>
						<?php endfor; ?>
					</select>
				</div>
				<div class="mb-3">
					<input type="submit" class="btn btn-primary" value="Ajouter l'écriture">
				</div>
			</form>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarobidy/Documents/GitHub/Sys_Info/resources/views/pages/ecriture/addEcriture.blade.php ENDPATH**/ ?>