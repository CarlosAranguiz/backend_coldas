@extends('layouts.simple.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('breadcrumb-title')
<h3>Alumnos</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">Alumnos</li>
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid">
    @if (Session::has('message'))
    <div class="{{ Session::get('alert') }} dark alert-dismissible fade show" role="alert">{{Session::get('message')}}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
    @endif
	<div class="row">
		<!-- Flexible table width Starts-->
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-pill btn-primary btn-air-primary" href="{{ route('alumnos.form.create') }}">Crear Alumno</a>
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
                                    @foreach ($usuarios as $usuario)
                                        <tr class="odd">
                                            <td>{{$usuario->id}}</td>
                                            <td>{{ $usuario->rut ?? 'No posee' }}</td>
                                            <td>{{ $usuario->nombre }}</td>
                                            <td>{{ $usuario->apellido_paterno }}</td>
                                            <td>{{ $usuario->apellido_materno }}</td>
                                            <td>{{ $usuario->nombre_social ?? 'No posee' }}</td>
                                            <td>{{ $usuario->email ?? 'No posee' }}</td>
                                            <td>{{ $usuario->telefono ?? 'No posee' }}</td>
                                            <td>{{ $usuario->carrera->universidad ?? 'No posee' }}</td>
                                            <td>{{ $usuario->carrera->nombre_carrera ?? 'No posee' }}</td>
                                            <td style="width: 13%"><button class="btn btn-danger btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-toggle="modal" data-bs-target="#modalEliminar" data-bs-id="{{ $usuario->id }}">Eliminar</button>
                                            <a href="{{ route('alumnos.detalle',$usuario->id) }}" class="btn btn-dark" type="button">Ver</a></td>
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
    <div class="modal fade" id="modalImportar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelDefault">Importar Alumnos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('alumnos.importar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Universidad</label>
                            <select class="form-select" name="universidadImportar" id="universidadImportar">
                                @foreach ($universidades as $universidad)
                                    <option value="{{ $universidad->id }}">{{ $universidad->nombre_universidad }}</option>
                                @endforeach
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
                <form action="{{ route('alumnos.delete') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/alumnos/alumnos.js')}}"></script>
@endsection