@extends('layouts.simple.master')

@section('title', 'Default')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Panel de Control</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Inicio</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<center><h3 class="mx-auto">Bienvenido al Sistema de Asistencia</h3></center>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
		<div class="col-12">
			<div class="card">
                <h5 class="card-title pt-5 ps-5">
                    Rotacion Actual
                </h5>
				<div class="card-body">
					<table id="tablaPracticas" class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>RUT</th>
                                <th>Nombre Alumno</th>
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
                            @foreach ($practicas as $practica)
                                <tr>
                                    <td>{{ $practica->usuario->rut }}</td>
                                    <td>{{ $practica->usuario->nombre.' '.$practica->usuario->apellido_paterno }}</td>
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
<script type="text/javascript">
	var session_layout = '{{ session()->get('layout') }}';
</script>
@endsection

@section('script')
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/alumnos/editar.js')}}"></script>
@endsection
