@extends('layouts.simple.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('breadcrumb-title')
<h3>Historial</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">Historial</li>
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
                            <button data-bs-toggle="modal" data-bs-target="#liberarDispositivo" class="btn btn-pill btn-primary btn-air-primary">Liberar Dispositivo</button>
                        </div>
                    </div>
					<div class="table-responsive mt-2">
						<table class="table cell-border" id="historial">
							<thead>
                                <tr>
                                    <th class="text-muted text-small text-uppercase">RUT</th>
                                    <th class="text-muted text-small text-uppercase">Nombre</th>
                                    <th class="text-muted text-small text-uppercase">Descripcion</th>
                                    <th class="text-muted text-small text-uppercase">Creado</th>
                                    <th class="empty">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historiales as $historial)
                                        <tr class="odd">
                                            <td>{{ $historial->alumno->rut ?? 'NO HAY REGISTRO' }}</td>
                                            <td>{{ $historial->alumno->nombre.' '.$historial->alumno->apellido_paterno ?? 'No posee' }}</td>
                                            <td>{{ $historial->descripcion }}</td>
                                            <td>{{ $historial->created_at }}</td>
                                            <td style="width: 13%">
                                            </td>
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

<div class="modal fade" id="liberarDispositivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelDefault">Importar Alumnos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('historial.limpiar') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">Rut Alumno</label>
                        <input type="text" class="form-control" name="rutAlumno" id="rutAlumno">
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
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#historial').DataTable({});
    });
</script>
@endsection