<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>File Manager</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Apps</li>
<li class="breadcrumb-item">File Manager</li>
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
					<div class="table-responsive">
						<table class="table cell-border" id="alumnos">
							<thead>
                                <tr>
                                    <th class="text-muted text-small text-uppercase">ID</th>
                                    <th class="text-muted text-small text-uppercase">RUT</th>
                                    <th class="text-muted text-small text-uppercase">Nombre</th>
                                    <th class="text-muted text-small text-uppercase">Apellido Paterno</th>
                                    <th class="text-muted text-small text-uppercase">Apellido Materno</th>
                                    <th class="text-muted text-small text-uppercase">Nombre Social</th>
                                    <th class="text-muted text-small text-uppercase">Correo</th>
                                    <th class="text-muted text-small text-uppercase">Telefono</th>
                                    <th class="text-muted text-small text-uppercase">Universidad</th>
                                    <th class="text-muted text-small text-uppercase">Carrera</th>
                                    <th class="empty">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="odd">
                                            <td><?php echo e($usuario->id); ?></td>
                                            <td><?php echo e($usuario->rut ?? 'No posee'); ?></td>
                                            <td><?php echo e($usuario->nombre); ?></td>
                                            <td><?php echo e($usuario->apellido_paterno); ?></td>
                                            <td><?php echo e($usuario->apellido_materno); ?></td>
                                            <td><?php echo e($usuario->nombre_social ?? 'No posee'); ?></td>
                                            <td><?php echo e($usuario->email ?? 'No posee'); ?></td>
                                            <td><?php echo e($usuario->telefono ?? 'No posee'); ?></td>
                                            <td><?php echo e($usuario->carrera->universidad ?? 'No posee'); ?></td>
                                            <td><?php echo e($usuario->carrera->nombre_carrera ?? 'No posee'); ?></td>
                                            <td style="width: 15%"><button class="btn btn-danger btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Eliminar</button>
                                            <button class="btn btn-danger btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-original-title="">Editar</button></td>
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
<script src="<?php echo e(asset('assets/js/alumnos/alumnos.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/wezate/Documents/Backend/backend_coldas/resources/views/administracion/alumnos.blade.php ENDPATH**/ ?>