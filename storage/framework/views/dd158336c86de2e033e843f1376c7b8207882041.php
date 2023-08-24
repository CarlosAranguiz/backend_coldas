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
                        <div class="col-12">
                            <button data-bs-toggle="modal" data-bs-target="#crear_eventos" class="btn btn-pill btn-primary btn-air-primary">Crear Evento</button>
                        </div>
                    </div>
					<div class="table-responsive mt-2">
						<table class="table cell-border" id="historial">
							<thead>
                                <tr>
                                    <th class="text-muted text-small text-uppercase">Titulo Evento</th>
                                    <th class="text-muted text-small text-uppercase">Descripcion Evento</th>
                                    <th class="text-muted text-small text-uppercase">Fecha</th>
                                    <th class="empty">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $eventos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="odd">
                                            <td><?php echo e($evento->titulo ?? 'NO HAY REGISTRO'); ?></td>
                                            <td><?php echo e($evento->descripcion ?? 'NO HAY REGISTRO '); ?></td>
                                            <td><?php echo e($evento->fecha ?? 'NO HAY REGISTRO'); ?></td>
                                            <td><?php echo e("Desde:".$evento->hora_desde ?? 'NO HAY REGISTRO' .' Hasta:'.$evento->hora_fin); ?></td>
                                            <td style="width: 13%">
                                                <button class="btn btn-primary">Resultado</button>
                                                <a href="<?php echo e(route('posteventquestions.index',$evento)); ?>" class="btn btn-primary">Preguntas</button>
                                                <a class="btn btn-danger" href="<?php echo e(route('eventos.eliminar',$evento->id)); ?>" >Eliminar</button>
                                            </td>
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

<div class="modal fade" id="crear_eventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelDefault">Crear Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('eventos.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">Titulo Evento</label>
                        <input type="text" class="form-control" name="titulo" id="titulo">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">Descripción de Evento</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">Fecha de Evento</label>
                        <input type="date" class="form-control" name="fecha" id="fecha">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Desde</label>
                        <input type="time" class="form-control" name="desde" id="desde">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Hasta</label>
                        <input type="time" class="form-control" name="hasta" id="hasta">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">Imagen</label>
                        <input type="file" class="form-control" name="imagen" id="imagen">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Crear Evento</button>
            </div>
            </form>
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

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/carlos/Documents/Backend/backend_coldas/resources/views/administracion/eventos/index.blade.php ENDPATH**/ ?>