@extends('layouts.simple.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('breadcrumb-title')
<h3>Eventos</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">Eventos</li>
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
                        {{-- <div class="col-12">
                            <button data-bs-toggle="modal" data-bs-target="#crear_eventos" class="btn btn-pill btn-primary btn-air-primary">Crear Evento</button>
                        </div> --}}
                    </div>
					<div class="table-responsive mt-2">
						<table class="table cell-border" id="historial">
							<thead>
                                <tr>
                                    <th class="text-muted text-small text-uppercase">Nombre Apellido</th>
                                    <th class="text-muted text-small text-uppercase">Correo</th>
                                    <th class="text-muted text-small text-uppercase">Fecha Inscripción</th>
                                    {{-- <th class="empty">&nbsp;</th> --}}
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inscritos as $inscrito)
                                        <tr class="odd">
                                            <td>{{ ($inscrito->usuario->nombre ?? 'NO HAY REGISTRO').' '.($inscrito->usuario->apellido_paterno ?? 'NO HAY REGISTRO') }}</td>
                                            <td>{{ $inscrito->usuario->email ?? 'NO HAY REGISTRO ' }}</td>
                                            <td>{{ $inscrito->created_at ?? 'NO HAY REGISTRO' }}</td>
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
{{--
<div class="modal fade" id="crear_eventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelDefault">Importar Alumnos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
</div> --}}
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#historial').DataTable({});
    });
</script>
@endsection
