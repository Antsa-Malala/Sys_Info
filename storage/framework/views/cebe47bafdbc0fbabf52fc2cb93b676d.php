<?php $__env->startSection('content'); ?>
	<div class="container">
		<div class="container">
			<div class="container">
				<div class="title">
					<h2 class="text-center text-decoration-underline">
						Consulter votre journal
					</h2>
				</div>
				<div class="col-lg-6 text-center">
					<table class="table">
						<thead>
							<th> Code Journal </th>
							<th> Libelle Journal </th>
						</thead>
						<tbody>
							<?php for($i = 0 ; $i < count($journaux) ; $i++): ?>
									<tr>
										<td>
											<a href="<?php echo e(url('journal/'.$journaux[$i]->code)); ?>" class="text-decoration-none">
												<?php echo e($journaux[$i]->code); ?>				
											</a>
										</td>
										<td>
											<?php echo e($journaux[$i]->libelle); ?>				
										</td>
									</tr>
							<?php endfor; ?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarobidy/Documents/GitHub/Sys_Info/resources/views/pages/journal/index.blade.php ENDPATH**/ ?>