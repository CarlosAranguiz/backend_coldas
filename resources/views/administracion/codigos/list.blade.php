@extends('layouts.simple.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('breadcrumb-title')
<h3>Codigos QR</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">CodigosQR</li>
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
                            <a class="btn btn-pill btn-primary btn-air-primary" data-bs-toggle="modal" data-original-title="test" data-bs-target="#crearCodigo">Crear Codigo</a>
                        </div>
                    </div>
					<div class="table-responsive mt-2">
						<table class="table cell-border" id="alumnos">
							<thead>
                                <tr>
                                    <th class="text-muted text-small text-uppercase">ID</th>
                                    <th class="text-muted text-small text-uppercase">Codigo</th>
                                    <th class="text-muted text-small text-uppercase">Codigo Encriptado</th>
                                    <th class="empty">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($codigos as $codigo)
                                        <tr class="odd">
                                            <td>{{$codigo->id}}</td>
                                            <td>{{ $codigo->texto_qr }}</td>
                                            <td>{{ $codigo->texto_encriptado }}</td>
                                            <td style="width: 15%"><button class="btn btn-danger" type="button" data-original-title="btn btn-danger btn-xs" title="" data-bs-toggle="modal" data-bs-target="#modalEliminar" data-bs-whatever="{{ $codigo->id }}">Eliminar</button>
                                            <a target="_blank" href="{{ route('codigos.ver',$codigo->id) }}" class="btn btn-dark" type="button">Ver</a></td>
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
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelDefault">Eliminar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('codigos.eliminar') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" name="idEliminar" id="idEliminar">
                        <center>¿Esta seguro que desea eliminar el codigo?</center>
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
<div class="modal fade" id="crearCodigo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear Codigo</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <form action="{{ route('codigos.crear') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Texto Codigo</label>
                            <input class="form-control" type="text" name="texto" id="texto">
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
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/alumnos/alumnos.js')}}"></script>
<script>
    var exampleModal = document.getElementById('modalEliminar')
    exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    console.log(recipient)
    document.getElementById('idEliminar').value = recipient;
    })
</script>
@endsection