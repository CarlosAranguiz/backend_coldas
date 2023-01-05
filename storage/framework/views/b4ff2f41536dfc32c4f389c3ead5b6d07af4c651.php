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
                        <div class="col-12">
                            <a class="btn btn-pill btn-primary btn-air-primary" href="<?php echo e(route('alumnos.form.create')); ?>">Crear Alumno</a>
                            <button data-bs-toggle="modal" data-bs-target="#modalImportar" class="btn btn-pill btn-primary btn-air-primary">Importar</button>
                        </div>
                    </div>
					<div class="table-responsive mt-2">
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
                                            <td style="width: 13%"><button class="btn btn-danger btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-toggle="modal" data-bs-target="#modalEliminar" data-bs-id="<?php echo e($usuario->id); ?>">Eliminar</button>
                                            <a href="<?php echo e(route('alumnos.detalle',$usuario->id)); ?>" class="btn btn-dark" type="button">Ver</a></td>
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
    <div class="modal fade" id="modalImportar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelDefault">Importar Alumnos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('alumnos.importar')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Universidad</label>
                            <select class="form-select" name="universidadImportar" id="universidadImportar">
                                <?php $__currentLoopData = $universidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $universidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($universidad->id); ?>"><?php echo e($universidad->nombre_universidad); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <label class="form-label">Excel</label>
                            <input type="file" class="form-control" name="excel" id="excel">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Importar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelDefault">Eliminar Alumno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('alumnos.delete')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="idEliminar" id="idEliminar">
                            <center>¿Esta seguro que desea eliminar el alumno?</center>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/alumnos/alumnos.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/wezate/Documents/Backend/backend_coldas/resources/views/administracion/alumnos/list.blade.php ENDPATH**/ ?>