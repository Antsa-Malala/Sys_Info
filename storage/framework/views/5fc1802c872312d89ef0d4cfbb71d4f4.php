<<<<<<< Updated upstream:resources/views/pages/codes/index.blade.php
@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="container">
			<div class="title">
            	<h2 class="text-center text-decoration-underline">
                	Liste de vos Codes journaux
            	</h2>
        	</div>
		</div>
		<a href="{{ url('journaux-insertion') }}" class="btn btn-primary">
        Ajouter
    </a>
    {{-- <a href="{{ url('/') }}" class="btn btn-primary">
        Importer Un fichier CSV
    </a> --}}
    <table class="table">
        <tr>
        <th>Numero de compte</th>
        <th>Libelle</th>
        </tr>
        @foreach ($codes as $plan)
        <tr>
            <td>{{ $plan->code}}</td>
            <td>{{ $plan->libelle}}</td>
            <td><a href="{{ url('/journaux-delete/'.$plan->idcode) }}" class="btn btn-danger">Supprimer</a></td>
            <td><a class="btn btn-primary px-3" href="{{ url('/journaux-update_journaux/'.$plan->idcode) }}" btn>Modifier</a></td>

        </tr>
        @endforeach
    </table>
    
    
	</div>	
@endsection
=======

<?php $__env->startSection('content'); ?>
	<div class="container">
		<div class="container">
			<div class="title">
            	<h2 class="text-center text-decoration-underline">
                	Liste de vos Codes journaux
            	</h2>
        	</div>
		</div>
        <div class="row my-3">
            <div class="search col-lg-3">
                <form id="formulaire_recherche" class="form" action="<?php echo e(url('/search_journal')); ?>" method="GET">
                    <div class="mb-3 d-flex">
                        <input type="text" class="form-control" onkeyup="fetchData(this)" name="recherche" placeholder="Rechercher code journal">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3">
        		<a href="<?php echo e(url('journaux-insertion')); ?>" class="btn btn-primary">
                    Ajouter
                </a>
            </div>
        </div>
    <table class="table table-responsive-xl border p-3">
        <thead>
            <th>Numero de compte</th>
            <th>Libelle</th>
            <th class="text-center">Actions</th>
            <th></th>
        </thead>
        <tbody class="main-result">
            <?php $__currentLoopData = $codes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($plan->code); ?></td>
                <td><?php echo e($plan->libelle); ?></td>
                <td><a class="btn btn-primary px-3" href="<?php echo e(url('/journaux-update_journaux/'.$plan->idcode)); ?>" btn>Modifier</a></td>
                <td><a href="<?php echo e(url('/journaux-delete/'.$plan->idcode)); ?>" class="btn btn-danger">Supprimer</a></td>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tbody class="search-result" id="resultats">
            
        </tbody>
    </table>
    
    
	</div>	
    <script src="<?php echo e(asset('js/search_journal.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarobidy/Documents/GitHub/Sys_Info/resources/views/pages/codes/index.blade.php ENDPATH**/ ?>
>>>>>>> Stashed changes:storage/framework/views/5fc1802c872312d89ef0d4cfbb71d4f4.php
