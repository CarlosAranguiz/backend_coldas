<?php $__env->startSection('title', 'Edit Profile'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Editar Alumno</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Users</li>
<li class="breadcrumb-item active">Edit Profile</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <?php if(Session::has('message')): ?>
    <div class="<?php echo e(Session::get('alert')); ?> dark alert-dismissible fade show" role="alert"><?php echo e(Session::get('message')); ?>

        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
    <?php endif; ?>
	<div class="edit-profile">
		<div class="row">
			<div class="col-xl-4">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title mb-0">Perfil Alumno</h4>
						<div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
					</div>
					<div class="card-body">
						<form>
							<div class="row mb-2">
								<div class="profile-title">
									<div class="media">
										<img class="img-70 rounded-circle" alt="" src="<?php echo e(asset('assets/images/logo/identidad_videos.png')); ?>">
										<div class="media-body">
											<h3 class="mb-1"><?php echo e($usuario->nombre.' '.$usuario->apellido_paterno); ?></h3>
											<p><?php echo e($usuario->carrera->nombre_carrera); ?></p>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-xl-8">
				<form action="<?php echo e(route('alumnos.update',$usuario->id)); ?>" method="POST" class="card">
                    <?php echo csrf_field(); ?>
					<div class="card-header">
						<h4 class="card-title mb-0">Edit Profile</h4>
						<div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6 col-md-6">
								<div class="mb-3">
									<label class="form-label">Rut</label>
									<input name="rut" type="text" class="form-control" value="<?php echo e($usuario->rut); ?>" />
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="mb-3">
									<label class="form-label">Correo Electrónico</label>
									<input name="email" type="text" class="form-control"  value="<?php echo e($usuario->email); ?>"/>
								</div>
							</div>
                            <div class="col-md-5">
								<div class="mb-3">
									<label class="form-label">Nombre</label>
									<input name="nombre" type="text" class="form-control"  value="<?php echo e($usuario->nombre); ?>"/>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="mb-3">
									<label class="form-label">Apellido Paterno</label>
                                    <input name="apellido_paterno" type="text" class="form-control" value="<?php echo e($usuario->apellido_paterno); ?>" />
								</div>
							</div>
							<div class="col-sm-6 col-md-4">
								<div class="mb-3">
									<label class="form-label">Apellido Materno</label>
									<input name="apellido_materno" type="text" class="form-control" value="<?php echo e($usuario->apellido_materno); ?>" />
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-3">
									<label class="form-label">Nombre Social</label>
                                    <input name="nombre_social" type="text" class="form-control" value="<?php echo e($usuario->nombre_social); ?>" />
								</div>
							</div>
							<div class="col-sm-6 col-md-4">
								<div class="mb-3">
									<label class="form-label">Telefono</label>
                                <input name="telefono" type="text" class="form-control" value="<?php echo e($usuario->telefono); ?>"/>
								</div>
							</div>
							<div class="col-md-4">
								<div class="mb-3">
                                    <label class="form-label">Universidades</label>
                                    <select class="form-select" name="universidad" id="universidad">
                                        <?php $__currentLoopData = $universidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $universidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($universidad->id); ?>"><?php echo e($universidad->nombre_universidad); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
								</div>
							</div>
                            <div class="col-md-4">
								<div class="mb-3">
                                    <input type="hidden" name="carreraHidden" id="carreraHidden" value="<?php echo e($usuario->carrera->nombre_carrera); ?>">
                                    <label class="form-label">Carrera</label>
                                    <select class="form-select" name="carrera" id="carrera">
                                    </select>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-end">
                        <a class="btn btn-secondary" href="<?php echo e(route('alumnos.list')); ?>">Volver</a>
						<button class="btn btn-primary" type="submit">Editar Alumno</button>
					</div>
				</form>
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title mb-0">Practicas</h4>
						<div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
					</div>
					<div class="card-body">
                        <div class="table-responsive">
                            <table id="tablaPracticas" class="table card-table table-vcenter text-nowrap">
                                <thead>
                                    <tr>
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
                                    <?php $__currentLoopData = $usuario->practicas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $practica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
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
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/alumnos/editar.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/wezate/Documents/Backend/backend_coldas/resources/views/administracion/alumnos/edit.blade.php ENDPATH**/ ?>