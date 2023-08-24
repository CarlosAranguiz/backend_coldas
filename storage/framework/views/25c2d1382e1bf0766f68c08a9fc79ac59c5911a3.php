<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Informes</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">Informes</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <?php if(Session::has('message')): ?>
    <div class="<?php echo e(Session::get('alert')); ?> dark alert-dismissible fade show" role="alert"><?php echo e(Session::get('message')); ?>

        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
    <?php endif; ?>
	<div class="row justify-content-center">
		<!-- Flexible table width Starts-->
		<div class="col-sm-6">
			<div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>Reportes Evaluacion Inicial y Final</h4>
                    </div>
                </div>
				<div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <a class="btn btn-primary" href="<?php echo e(route('informes.excel',0)); ?>">Reporte Evaluacion Inicial</a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-primary" href="<?php echo e(route('informes.excel',1)); ?>">Reporte Evaluacion Final</a>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $('#historial').DataTable({});
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/carlos/Documents/Backend/backend_coldas/resources/views/administracion/config/informes.blade.php ENDPATH**/ ?>