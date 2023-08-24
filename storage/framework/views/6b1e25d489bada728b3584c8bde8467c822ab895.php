<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Eventos</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">Eventos</li>
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
	<div class="row">
		<!-- Flexible table width Starts-->
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
                    <div class="row">
                        
                    </div>
					<div class="table-responsive mt-2">
						<table class="table cell-border" id="historial">
							<thead>
                                <tr>
                                    <th class="text-muted text-small text-uppercase">Nombre Apellido</th>
                                    <th class="text-muted text-small text-uppercase">Correo</th>
                                    <th class="text-muted text-small text-uppercase">Fecha Inscripción</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $inscritos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inscrito): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="odd">
                                            <td><?php echo e(($inscrito->usuario->nombre ?? 'NO HAY REGISTRO').' '.($inscrito->usuario->apellido_paterno ?? 'NO HAY REGISTRO')); ?></td>
                                            <td><?php echo e($inscrito->usuario->email ?? 'NO HAY REGISTRO '); ?></td>
                                            <td><?php echo e($inscrito->created_at ?? 'NO HAY REGISTRO'); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
						</table>
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

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/carlos/Documents/Backend/backend_coldas/resources/views/administracion/eventos/inscritos.blade.php ENDPATH**/ ?>