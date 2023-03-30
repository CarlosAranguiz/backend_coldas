@extends('layouts.simple.master')
@section('title', 'Edit Profile')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Editar Alumno</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Users</li>
<li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')

<div class="container-fluid">
    @if (Session::has('message'))
    <div class="{{ Session::get('alert') }} dark alert-dismissible fade show" role="alert">{{Session::get('message')}}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
    @endif
	<div class="edit-profile">
		<div class="row">
			<div class="col-xl-4">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title mb-0">Perfil Alumno <div class="float-end"><a style="font-size:14px;" href="{{ route('alumnos.list') }}">Volver</a></div></h4>
						<div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
					</div>
					<div class="card-body">
						<form>
							<div class="row mb-2">
								<div class="profile-title">
									<div class="media">
										<img class="img-70 rounded-circle" alt="" src="{{ asset('assets/images/logo/identidad_videos.png')}}">
										<div class="media-body">
											<h3 class="mb-1">{{ $usuario->nombre.' '.$usuario->apellido_paterno }}</h3>
											<p>{{ $usuario->carrera->nombre_carrera }}</p>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-xl-8">
				<form action="{{ route('alumnos.update',$usuario->id) }}" method="POST" class="card">
                    @csrf
					<div class="card-header">
						<h4 class="card-title mb-0">Editar Alumno</h4>
						<div class="card-options">
							<a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6 col-md-6">
								<div class="mb-3">
									<label class="form-label">Rut</label>
									<input name="rut" type="text" class="form-control" value="{{ $usuario->rut }}" />
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="mb-3">
									<label class="form-label">Correo Electrónico</label>
									<input name="email" type="text" class="form-control"  value="{{ $usuario->email }}"/>
								</div>
							</div>
                            <div class="col-md-5">
								<div class="mb-3">
									<label class="form-label">Nombre</label>
									<input name="nombre" type="text" class="form-control"  value="{{ $usuario->nombre }}"/>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="mb-3">
									<label class="form-label">Apellido Paterno</label>
                                    <input name="apellido_paterno" type="text" class="form-control" value="{{ $usuario->apellido_paterno }}" />
								</div>
							</div>
							<div class="col-sm-6 col-md-4">
								<div class="mb-3">
									<label class="form-label">Apellido Materno</label>
									<input name="apellido_materno" type="text" class="form-control" value="{{ $usuario->apellido_materno }}" />
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-3">
									<label class="form-label">Nombre Social</label>
                                    <input name="nombre_social" type="text" class="form-control" value="{{ $usuario->nombre_social }}" />
								</div>
							</div>
							<div class="col-sm-6 col-md-4">
								<div class="mb-3">
									<label class="form-label">Telefono</label>
                                <input name="telefono" type="text" class="form-control" value="{{ $usuario->telefono }}"/>
								</div>
							</div>
							<div class="col-md-4">
								<div class="mb-3">
                                    <label class="form-label">Universidades</label>
                                    <select class="form-select" name="universidad" id="universidad">
                                        @foreach ($universidades as $universidad)
                                            @if ($universidad->id == $usuario->carrera->id_universidad)
												<option selected value="{{ $universidad->id }}">{{ $universidad->nombre_universidad }}</option>
											@endif
											<option value="{{ $universidad->id }}">{{ $universidad->nombre_universidad }}</option>
                                        @endforeach
                                    </select>
								</div>
							</div>
                            <div class="col-md-4">
								<div class="mb-3">
                                    <input type="hidden" name="carreraHidden" id="carreraHidden" value="{{ $usuario->carrera->nombre_carrera }}">
                                    <label class="form-label">Carrera</label>
                                    <select class="form-select" name="carrera" id="carrera">
                                    </select>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-end">
                        <a class="btn btn-secondary" href="{{ route('alumnos.list') }}">Volver</a>
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
						<div class="row">
							<div class="col-12">
								<button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalCrearPractica">Crear Practica</button>
							</div>
						</div>
                        <div class="table-responsive mt-3">
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
                                    @foreach ($usuario->practicas as $practica)
                                        <tr>
                                            <td>{{ $practica->campo_clinico }}</td>
                                            <td>{{ $practica->nivel_cursado }}</td>
                                            <td>{{ $practica->tipo_practica }}</td>
                                            <td>{{ $practica->fecha_inicio }}</td>
                                            <td>{{ $practica->fecha_termino }}</td>
                                            <td>{{ $practica->hora_inicio }}</td>
                                            <td>{{ $practica->hora_termino }}</td>
											<td>{{ $practica->hora_registro_inicio ?? 'No Registrado' }}</td>
                                            <td>{{ $practica->hora_registro_termino ?? 'No Registrado' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalCrearPractica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabelDefault">Asignar Practica</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="{{ route('alumnos.asignar_practica') }}" method="POST">
			@csrf
				<div class="modal-body">
					<div class="row">
						<input type="hidden" name="id_usuario" id="id_usuario" value="{{ $usuario->id }}">
						<div class="mb-3 col-md-6 col-sm-12">
							<label class="form-label">Campo Clinico</label>
							<input name="campo_clinico" type="text" class="form-control" />
						</div>
						<div class="mb-3 col-md-6 col-sm-12">
							<label class="form-label">Nivel Cursado</label>
							<input name="nivel_cursado" type="text" class="form-control" />
						</div>
					</div>
					<div class="row">
						<div class="mb-3 col-md-6 col-sm-12">
							<label class="form-label">Docente</label>
							<input name="docente" required type="text" class="form-control" />
						</div>
						<div class="mb-3 col-md-6 col-sm-12">
							<label class="form-label">Telefono Docente</label>
							<input name="telefono_docente" required type="text" class="form-control" />
						</div>
					</div>
					<div class="row">
						<div class="mb-3 col-md-12 col-sm-12">
							<label class="form-label">Tipo de Practica</label>
							<input name="tipo_practica" required type="text" class="form-control" />
						</div>
						<div class="mb-3 col-md-6 col-sm-12">
							<label class="form-label">Fecha Inicio</label>
							<input name="fecha_inicio" required type="date" class="form-control" />
						</div>
						<div class="mb-3 col-md-6 col-sm-12">
							<label class="form-label">Fecha Fin</label>
							<input name="fecha_fin" required type="date" class="form-control" />
						</div>
					</div>
					<div class="row">
						<div class="mb-3 col-md-6 col-sm-12">
							<label class="form-label">Hora Entrada</label>
							<input name="hora_entrada" type="time" class="form-control" />
						</div>
						<div class="mb-3 col-md-6 col-sm-12">
							<label class="form-label">Hora Salida</label>
							<input name="hora_salida" type="time" class="form-control" />
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/alumnos/editar.js')}}"></script>
@endsection