@extends('layouts.simple.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('breadcrumb-title')
<h3>{{ $universidad->nombre_universidad }}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">Universidad</li>
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid">
    @if (Session::has('message'))
    <div class="alert {{ Session::get('alert') }} dark alert-dismissible fade show" role="alert">{{Session::get('message')}}
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
                            <a class="btn btn-pill btn-primary btn-air-primary" data-bs-toggle="modal" data-original-title="test" data-bs-target="#crearCarrera">Crear Carrera</a>
                        </div>
                    </div>
					<div class="table-responsive mt-2">
						<table class="table cell-border" id="alumnos">
							<thead>
                                <tr>
                                    <th class="text-muted text-small text-uppercase">Carrera</th>
                                    <th class="empty">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($universidad->carrera as $carrera)
                                        <tr class="odd">
                                            <td>{{ $carrera->nombre_carrera ?? 'No posee' }}</td>
                                            <td style="width: 15%"><button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalEliminarCarrera" data-bs-id="{{ $universidad->id }}">Eliminar</button>
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
<div class="modal fade" id="crearCarrera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear Carrera</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <form action="{{ route('carrera.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Carrera</label>
                            <input type="hidden" name="id" id="id" value="{{ $universidad->id }}">
                            <input class="form-control" type="text" name="nombre" id="nombre">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEliminarCarrera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelDefault">Eliminar Carrera</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('carrera.delete') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" name="idEliminar" id="idEliminar">
                        <center>¿Esta seguro que desea eliminar la carrera?</center>
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
<script src="{{asset('assets/js/universidad/datatable.js')}}"></script>
<script>
    var modalEliminar = document.getElementById('modalEliminarCarrera')
    modalEliminar.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget
    var id = button.getAttribute('data-bs-id')
    document.getElementById('idEliminar').value = id;
    })
</script>
@endsection