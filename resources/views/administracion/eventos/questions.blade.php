@extends('layouts.simple.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('breadcrumb-title')
<h3>Preguntas</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">Preguntas</li>
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
                            <button data-bs-toggle="modal" data-bs-target="#crear_pregunta" class="btn btn-pill btn-primary btn-air-primary">Crear Pregunta</button>
                        </div>
                    </div>
					<div class="table-responsive mt-2">
						<table class="table cell-border" id="historial">
							<thead>
                                <tr>
                                    <th class="text-muted text-small text-uppercase">Titulo Evento</th>
                                    <th class="text-muted text-small text-uppercase">Pregunta</th>
                                    <th class="empty">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $question)
                                        <tr class="odd">
                                            <td>{{ $question->evento->titulo ?? 'NO HAY REGISTRO ' }}</td>
                                            <td>{{ $question->question_text ?? 'NO HAY REGISTRO' }}</td>
                                            <td style="width: 13%">
                                                <a href="{{ route('posteventquestions.show',$question) }}" class="btn btn-primary">Opciones</button>
                                                <a class="btn btn-danger" href="{{route('posteventquestions.destroy',$question)}}" >Eliminar</button>
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

<div class="modal fade" id="crear_pregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelDefault">Crear Pregunta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('posteventquestions.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="event_id" value="{{ $id }}">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">Pregunta</label>
                        <textarea style="resize: false" class="form-control" name="question_text" id="question_text"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Crear Pregunta</button>
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
