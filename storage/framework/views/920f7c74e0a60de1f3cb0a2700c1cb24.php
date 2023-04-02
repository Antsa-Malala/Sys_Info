<<<<<<< Updated upstream:resources/views/pages/codes/update.blade.php
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container">
        <div class="title">
            <h3 class="text-center text-decoration-underline">
                Modifier {{ $code->code }}
            </h3>
        </div>
        <form action="/journaux-update" method="POST" id="form">
            @csrf
            <input type="hidden" name="idcode" value="{{$code->idcode}}">
            <div class="my-3">
                <label class="form-label" for="numerocompte">Code journaux</label>
                <input class="form-control" type="text" name="code" value="{{ $code->code }}" id="numerocompte" data-parsley-required="true">
            </div>
            <div class="my-3">
                <label class="form-label" for="libelle">Libelle</label>
                <input class="form-control" type="text" name="libelle" id="libelle" value="{{ $code->libelle }}" data-parsley-required="true">
            </div>
            <div class="mb-3">
                <input type="submit" value="Inserer" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

@endsection
=======

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="container">
        <div class="title">
            <h3 class="text-center text-decoration-underline">
                Modifier <?php echo e($code->code); ?>

            </h3>
        </div>
        <form action="/journaux-update" method="POST" id="form">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="idcode" value="<?php echo e($code->idcode); ?>">
            <div class="my-3">
                <label class="form-label" for="numerocompte">Code journaux</label>
                <input class="form-control" type="text" name="code" value="<?php echo e($code->code); ?>" id="numerocompte" data-parsley-required="true">
            </div>
            <div class="my-3">
                <label class="form-label" for="libelle">Libelle</label>
                <input class="form-control" type="text" name="libelle" id="libelle" value="<?php echo e($code->libelle); ?>" data-parsley-required="true">
            </div>
            <div class="mb-3">
                <input type="submit" value="Inserer" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarobidy/Documents/GitHub/Sys_Info/resources/views/pages/codes/update.blade.php ENDPATH**/ ?>
>>>>>>> Stashed changes:storage/framework/views/920f7c74e0a60de1f3cb0a2700c1cb24.php
