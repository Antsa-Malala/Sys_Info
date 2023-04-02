<?php $__env->startSection('content'); ?>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	
	
	<div class="container">
		<div class="container my-3 card card-body">
				<div class="title text-center ">
					<h2 class="text-decoration-underline">
						Ajouter des opérations pour : <?php echo e($ecriture->libelle); ?>

					</h2>
				</div>
			<form id="ajax-form">
				
				<table class="table" id="opr">
					<thead>
						<th> Date </th>
						<th> N° Piece </th>
						<th> Compte </th>
						<th> Compte Tiers </th>
						<th> Libelle </th>
						<th> Debit </th>
						<th> Credit </th>
					</thead>
					<tbody  id="operations">
						<?php echo e(csrf_field()); ?>

						<tr id="original">
							<td>
								<input type="date" class="form-control" name="dates[]" value="<?php echo e($ecriture->dateecriture); ?>" readonly>
							</td>
							<td>
								<div class="input-group"> 
									<input type="text" name="ref[]" class="form-control" value="<?php echo e($ecriture->createReference()); ?>" id="" readonly>
									
									
									
									
									
								</div>
							</td>
							<td> 
								
								
								<select name="compte[]" class="form-select" >
									<option value=""> Choissez Un compte </option>
									<?php for( $i = 0 ; $i < count($comptes) ; $i++ ): ?>
										<option value="<?php echo e($comptes[$i]->compte); ?>"> 
										<?php echo e($comptes[$i]->compte." - ".$comptes[$i]->libelle); ?> </option>
									<?php endfor; ?>
								</select>
							</td>
							<td>
								
								<select name="fo-c[]" class="form-select" id="">
									<option value=""> Choissez Un compte Tiers </option>
									<?php for( $i = 0 ; $i < count($tiers) ; $i++ ): ?>
										<option value="<?php echo e($tiers[$i]->numero); ?>"> 
										<?php echo e($tiers[$i]->numero." - ".$tiers[$i]->libelle); ?> </option>
									<?php endfor; ?>
								</select>
							</td>
							<td>
								
									
								<input type="text" name="libelle[]" id="" class="form-control" value="<?php echo e($ecriture->libelle); ?>" readonly>
								
							</td>
							<td>
								
									
								<input type="number" name="debit[]" id=""  class="form-control">
								
							</td>
							<td>
								
									
								<input type="number" name="credit[]" id=""  class="form-control">
								
							</td>
						</tr>
					</tbody>
				</table>
				<span onclick="clone()" class="my-3 btn btn-dark">
					Ajouter une ligne
				</span>
				
				<div class="my-3">
					<button type="button" onclick="submitForm()"  class="btn btn-primary"> Enregistrer les opérations </button>
					
				</div>
			</form>
		</div>
	</div>
	<script src="<?php echo e(URL::asset('js/app.js')); ?>"></script>
	
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarobidy/Documents/GitHub/Sys_Info/resources/views/pages/operations/addoperation.blade.php ENDPATH**/ ?>