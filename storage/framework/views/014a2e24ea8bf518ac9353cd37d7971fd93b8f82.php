<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Alumnos</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">Alumnos</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<!-- Flexible table width Starts-->
		<div class="col-sm-12">
			<div class="card">
                <div class="card-body">
                    <form class="theme-form mega-form" action="<?php echo e(route('alumnos.create')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">RUT</label>
                                <input name="rut" type="text" class="form-control" />
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Nombre</label>
                                <input name="nombre" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Apellido Paterno</label>
                                <input name="apellido_paterno" type="text" class="form-control" />
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Apellido Materno</label>
                                <input name="apellido_materno" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Nombre Social</label>
                                <input name="nombre_social" type="text" class="form-control" />
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Correo</label>
                                <input name="email" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-sm-12 col-md-4">
                                <label class="form-label">Telefono</label>
                                <input name="telefono" type="text" class="form-control" />
                            </div>
                            <div class="mb-3 col-sm-12 col-md-4">
                                <label class="form-label">Universidades</label>
                                <select class="form-select" name="universidad" id="universidad">
                                    <?php $__currentLoopData = $universidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $universidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($universidad->id); ?>"><?php echo e($universidad->nombre_universidad); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3 col-sm-12 col-md-4">
                                <label class="form-label">Carrera</label>
                                <select class="form-select" name="carrera" id="carrera">
    
                                </select>
                            </div>
                        </div>
                    <hr class="mt-4 mb-4">
                        <div class="col-auto">
                            <button class="btn btn-primary btn-md" type="submit">Crear</button>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/alumnos/crear.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/wezate/Documents/Backend/backend_coldas/resources/views/administracion/alumnos/create.blade.php ENDPATH**/ ?>