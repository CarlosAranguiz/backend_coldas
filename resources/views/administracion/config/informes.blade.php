@extends('layouts.simple.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('breadcrumb-title')
<h3>Informes</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">Informes</li>
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
	<div class="row justify-content-center">
		<!-- Flexible table width Starts-->
		<div class="col-sm-6">
			<div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>Reportes Evaluacion Inicial y Final</h4>
                    </div>
                </div>
				<div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <a class="btn btn-primary" href="{{route('informes.excel',0)}}">Reporte Evaluacion Inicial</a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-primary" href="{{route('informes.excel',1)}}">Reporte Evaluacion Final</a>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- <div class="modal fade" id="crear_links" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelDefault">Crear Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('links.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">Titulo</label>
                        <input type="text" class="form-control" name="titulo" id="titulo">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">URL</label>
                        <input type="text" class="form-control" name="url" id="url">
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
                <button type="submit" class="btn btn-primary">Crear Link</button>
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
