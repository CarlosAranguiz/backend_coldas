<?php $__env->startSection('title', 'Default'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/animate.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/chartist.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/date-picker.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Panel de Control</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Inicio</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<center><h3 class="mx-auto">Bienvenido al Sistema de Asistencia</h3></center>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
		<div class="col-12">
			<div class="card">
                <h5 class="card-title pt-5 ps-5">
                    Rotacion Actual
                </h5>
				<div class="card-body">
					<table id="tablaPracticas" class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>RUT</th>
                                <th>Nombre Alumno</th>
                                <th>Campo Clinico</th>
                                <th>Nivel Cursado</th>
                                <th>Tipo de Practica</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Termino</th>
                                <th>Hora Inicio</th>
                                <th>Hora Termino</th>
                                <th>Hora Ingreso</th>
                                <th>Hora Salida</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $practicas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $practica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($practica->usuario->rut); ?></td>
                                    <td><?php echo e($practica->usuario->nombre.' '.$practica->usuario->apellido_paterno); ?></td>
                                    <td><?php echo e($practica->campo_clinico); ?></td>
                                    <td><?php echo e($practica->nivel_cursado); ?></td>
                                    <td><?php echo e($practica->tipo_practica); ?></td>
                                    <td><?php echo e($practica->fecha_inicio); ?></td>
                                    <td><?php echo e($practica->fecha_termino); ?></td>
                                    <td><?php echo e($practica->hora_inicio); ?></td>
                                    <td><?php echo e($practica->hora_termino); ?></td>
                                    <td><?php echo e($practica->hora_registro_inicio ?? 'No Registrado'); ?></td>
                                    <td><?php echo e($practica->hora_registro_termino ?? 'No Registrado'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var session_layout = '<?php echo e(session()->get('layout')); ?>';
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/chart/chartist/chartist.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/chart/knob/knob.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/chart/knob/knob-chart.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/chart/apex-chart/apex-chart.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/chart/apex-chart/stock-prices.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/notify/bootstrap-notify.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/dashboard/default.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/alumnos/editar.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/carlos/Documents/Backend/backend_coldas/resources/views/dashboard/index.blade.php ENDPATH**/ ?>