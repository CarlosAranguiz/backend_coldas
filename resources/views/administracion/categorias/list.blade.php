@extends('layouts.simple.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('breadcrumb-title')
<h3>Categorias</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">Categorias</li>
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
                            <a class="btn btn-pill btn-primary btn-air-primary" data-bs-toggle="modal" data-original-title="test" data-bs-target="#crearSub">Crear Subcategoria</a>
                        </div>
                    </div>
					<div class="table-responsive mt-2">
						<table class="table cell-border" id="alumnos">
							<thead>
                                <tr>
                                    <th class="text-muted text-small text-uppercase">Tema</th>
                                    <th class="text-muted text-small text-uppercase">Categoria</th>
                                    <th class="empty">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subcategorias as $subcategoria)
                                        <tr class="odd">
                                            <td>{{ $subcategoria->tema ?? 'No posee' }}</td>
                                            <td>{{ $subcategoria->categoria ?? 'No posee' }}</td>
                                            <td style="width: 15%">
                                            <a href="{{ route('universidad.detalle',$subcategoria->id) }}" class="btn btn-dark" type="button">Carreras</a></td>
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
<div class="modal fade" id="crearSub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear Categoria</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Tema</label>
                            <select class="form-select" id="tema" name="tema">
                                <option value="0" disabled selected> Seleccione un tema </option>
                                <option value="Pregrado">Pregrado</option>
                                <option value="Postgrado">Postgrado</option>
                                <option value="Investigación">Investigación</option>
                                <option value="Extensión">Extensión</option>
                            </select>
                        </div>
                        <div class="col-12 mt-2">
                            <label class="form-label">Categoria</label>
                            <select class="form-select" id="categoria" name="categoria">
                                <option value="0" disabled selected> Seleccione un tema </option>
                                <option value="Alimentación">Alimentación</option>
                                <option value="Alivio del Dolor">Alivio del Dolor</option>
                                <option value="Anatomía Patológica">Anatomía Patológica</option>
                                <option value="CAE">CAE</option>
                                <option value="Cirugía">Cirugía</option>
                                <option value="CMA">CMA</option>
                                <option value="CR Pediátrico">CR Pediátrico</option>
                                <option value="Dental">Dental</option>
                                <option value="Dermatología">Dermatología</option>
                                <option value="Esterilización">Esterilización</option>
                                <option value="Farmacia">Farmacia</option>
                                <option value="Ginecología y Obstetricia">Ginecología y Obstetricia</option>
                                <option value="Hosp Domiciliaria">Hosp Domiciliaria</option>
                                <option value="Imagenología">Imagenología</option>
                                <option value="Infectología">Infectología</option>
                                <option value="Laboratorio">Laboratorio</option>
                                <option value="MED. Fisica y REHAB">MED. Fisica y REHAB</option>
                                <option value="Medicina">Medicina</option>
                                <option value="Neurocirugía">Neurocirugía</option>
                                <option value="Oftalmología">Oftalmología</option>
                                <option value="Otorrino">Otorrino</option>
                                <option value="Pabellones Quirurgicos">Pabellones Quirurgicos</option>
                                <option value="Pediatría">Pediatría</option>
                                <option value="Psiquiatría Adulto">Psiquiatría Adulto</option>
                                <option value="Psiquiatría AT Abierta">Psiquiatría AT Abierta</option>
                                <option value="Psiquiatría Infanto Juvenil">Psiquiatría Infanto Juvenil</option>
                                <option value="Traumatología">Traumatología</option>
                                <option value="UMT">UMT</option>
                                <option value="UPC Adulto">UPC Adulto</option>
                                <option value="UPC Neo">UPC Neo</option>
                                <option value="Urología">Urología</option>
                            </select>
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
<div class="modal fade" id="modalImportar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelDefault">Importar Alumnos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('universidad.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
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
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/universidad/datatable.js')}}"></script>
@endsection