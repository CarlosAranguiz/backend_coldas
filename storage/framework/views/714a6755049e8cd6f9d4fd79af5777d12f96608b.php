<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<a href="<?php echo e(route('dashboard')); ?>"><img class="img-fluid for-light" src="<?php echo e(asset('assets/images/logo/logo_rad_solo.png')); ?>" width="97px" height="28px" alt=""><img class="img-fluid for-dark" src="<?php echo e(asset('assets/images/logo/logo_dark.png')); ?>" alt=""></a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href="<?php echo e(route('dashboard')); ?>"><img class="img-fluid" src="<?php echo e(asset('assets/images/logo/identidad_videos.png')); ?>" height="28px" width="40px" alt=""></a></div>
		<nav class="sidebar-main mt-5">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="<?php echo e(route('dashboard')); ?>"><img class="img-fluid" src="<?php echo e(asset('assets/images/logo/logo-icon.png')); ?>" alt=""></a>
						<div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>
					
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='file-manager' ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
							<i data-feather="home"></i><span>Inicio</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == '/dashboard' ? 'active' : ''); ?>" href="#"><i data-feather="settings"></i><span class="lan-3">Administración</span>
							<div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == '/dashboard' ? 'down' : 'right'); ?>"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/administracion' ? 'block;' : 'none;'); ?>">
							<li><a class="lan-4 <?php echo e(Route::currentRouteName()=='alumnos.list' ? 'active' : ''); ?>" href="<?php echo e(route('alumnos.list')); ?>">Alumnos</a></li>
							<li><a class="lan-4 <?php echo e(Route::currentRouteName()=='universidad.list' ? 'active' : ''); ?>" href="<?php echo e(route('universidad.list')); ?>">Universidades</a></li>
							<li><a class="lan-4 <?php echo e(Route::currentRouteName()=='codigos.list' ? 'active' : ''); ?>" href="<?php echo e(route('codigos.list')); ?>">CodigosQR</a></li>
							<li><a class="lan-4 <?php echo e(Route::currentRouteName()=='categorias.list' ? 'active' : ''); ?>" href="<?php echo e(route('categorias.list')); ?>">Categorias</a></li>
						</ul>
					</li>
                    <li class="sidebar-list">
						<a class="sidebar-link sidebar-title <?php echo e(request()->route()->getPrefix() == '/dashboard' ? 'active' : ''); ?>" href="#"><i data-feather="settings"></i><span class="lan-3">Aplicación</span>
							<div class="according-menu"><i class="fa fa-angle-<?php echo e(request()->route()->getPrefix() == '/dashboard' ? 'down' : 'right'); ?>"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: <?php echo e(request()->route()->getPrefix() == '/administracion' ? 'block;' : 'none;'); ?>">
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='publicaciones.list' ? 'active' : ''); ?>" href="<?php echo e(route('publicaciones.list')); ?>">Publicaciones</a></li>
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='eventos.list' ? 'active' : ''); ?>" href="<?php echo e(route('eventos.list')); ?>">Eventos</a></li>
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='contactos.list' ? 'active' : ''); ?>" href="<?php echo e(route('contactos.list')); ?>">Contacto Alumno</a></li>
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='nosotros.list' ? 'active' : ''); ?>" href="<?php echo e(route('nosotros.list')); ?>">Departamento</a></li>
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='convenios.list' ? 'active' : ''); ?>" href="<?php echo e(route('convenios.list')); ?>">Convenios</a></li>
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='recursos.list' ? 'active' : ''); ?>" href="<?php echo e(route('recursos.list')); ?>">Recursos Educativos</a></li>
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='links.list' ? 'active' : ''); ?>" href="<?php echo e(route('links.list')); ?>">Links Utiles</a></li>
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='config' ? 'active' : ''); ?>" href="<?php echo e(route('config')); ?>">Configuración</a></li>
                            <li><a class="lan-4 <?php echo e(Route::currentRouteName()=='informes' ? 'active' : ''); ?>" href="<?php echo e(route('informes')); ?>">Informes</a></li>
						</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='historial.list' ? 'active' : ''); ?>" href="<?php echo e(route('historial.list')); ?>">
							<i data-feather="alert-octagon"></i><span>Historial</span>
						</a>
					</li>
				</ul>
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>
<?php /**PATH /Users/carlos/Documents/Backend/backend_coldas/resources/views/layouts/simple/sidebar.blade.php ENDPATH**/ ?>