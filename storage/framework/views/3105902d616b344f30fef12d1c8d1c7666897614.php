<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Publicacion</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">Publicación</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-md-12 col-sm-12">
                            <div class="alert alert-dark outline fade show" role="alert">
                                <strong>Información!</strong> Si es solo imagen, por favor llenar Titulo y Descripción.
                                </button>
                             </div>
                        </div>
                    </div>
                    <form class="theme-form mega-form" action="<?php echo e(route('publicaciones.update',$post->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Titulo (*)</label>
                                <input name="title" type="text" class="form-control" value="<?php echo e($post->title); ?>"/>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Descripcíon</label>
                                <input name="description" type="text" class="form-control" value="<?php echo e($post->description); ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12 col-sm-12">
                                <label class="form-label">Contenido</label>
                                <textarea name="content" type="text" class="form-control"><?php echo e($post->content); ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12 col-sm-12">
                                <label class="form-label">Imagen</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-6">
                                <label class="form-label">Documentos</label>
                                <input type="file" multiple name="docs[]" id="docs" class="form-control">
                            </div>
                            <div class="mb-3 col-md-6 col-sm-6">
                                <label class="form-label">Autor</label>
                                <input type="text" name="autor" id="autor" class="form-control" value="<?php echo e($post->author); ?>">
                            </div>
                        </div>
                    <hr class="mt-4 mb-4">
                        <div class="col-auto">
                            <button class="btn btn-primary btn-md" type="submit">Editar</button>
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

<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/carlos/Documents/Backend/backend_coldas/resources/views/administracion/post/edit.blade.php ENDPATH**/ ?>