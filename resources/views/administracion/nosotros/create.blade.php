@extends('layouts.simple.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('breadcrumb-title')
<h3>Nuestro Departamento</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">Nosotros</li>
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
                <div class="card-body">
                    <form class="theme-form mega-form" action="{{ route('nosotros.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Nombre Apellido (*)</label>
                                <input name="nombre" type="text" class="form-control" />
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Cargo (*)</label>
                                <input name="cargo" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Anexo (*)</label>
                                <input type="text" name="anexo" id="anexo" class="form-control">
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Ubicación (*)</label>
                                <input type="text" name="ubicacion" id="ubicacion" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Foto Funcionario (*)</label>
                                <input type="file" name="imagen" id="imagen" class="form-control">
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Correo Electrónico (*)</label>
                                <input type="email" name="correo" id="correo" class="form-control">
                            </div>
                        </div>
                    <hr class="mt-4 mb-4">
                        <div class="col-auto">
                            <button class="btn btn-primary btn-md" type="submit">Crear</button>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/alumnos/crear.js')}}"></script>
@endsection
