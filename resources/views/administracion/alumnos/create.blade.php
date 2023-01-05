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
	<div class="row">
		<!-- Flexible table width Starts-->
		<div class="col-sm-12">
			<div class="card">
                <div class="card-body">
                    <form class="theme-form mega-form" action="{{ route('alumnos.create') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">RUT</label>
                                <input name="rut" type="text" class="form-control" />
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Nombre</label>
                                <input name="nombre" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Apellido Paterno</label>
                                <input name="apellido_paterno" type="text" class="form-control" />
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Apellido Materno</label>
                                <input name="apellido_materno" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Nombre Social</label>
                                <input name="nombre_social" type="text" class="form-control" />
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Correo</label>
                                <input name="email" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-sm-12 col-md-4">
                                <label class="form-label">Telefono</label>
                                <input name="telefono" type="text" class="form-control" />
                            </div>
                            <div class="mb-3 col-sm-12 col-md-4">
                                <label class="form-label">Universidades</label>
                                <select class="form-select" name="universidad" id="universidad">
                                    @foreach ($universidades as $universidad)
                                        <option value="{{ $universidad->id }}">{{ $universidad->nombre_universidad }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-sm-12 col-md-4">
                                <label class="form-label">Carrera</label>
                                <select class="form-select" name="carrera" id="carrera">
    
                                </select>
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