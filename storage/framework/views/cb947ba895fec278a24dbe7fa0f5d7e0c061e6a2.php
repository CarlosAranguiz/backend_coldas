<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Nuestro Departamento</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">Nosotros</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
                <div class="card-body">
                    <form class="theme-form mega-form" action="<?php echo e(route('nosotros.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Nombre Apellido (*)</label>
                                <input name="nombre" type="text" class="form-control" />
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Cargo (*)</label>
                                <input name="cargo" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Anexo (*)</label>
                                <input type="text" name="anexo" id="anexo" class="form-control">
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Ubicación (*)</label>
                                <input type="text" name="ubicacion" id="ubicacion" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Foto Funcionario (*)</label>
                                <input type="file" name="imagen" id="imagen" class="form-control">
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Correo Electrónico (*)</label>
                                <input type="email" name="correo" id="correo" class="form-control">
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

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/carlos/Documents/Backend/backend_coldas/resources/views/administracion/nosotros/create.blade.php ENDPATH**/ ?>