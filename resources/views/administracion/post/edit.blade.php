@extends('layouts.simple.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('breadcrumb-title')
<h3>Publicacion</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Administracíon</li>
<li class="breadcrumb-item">Publicación</li>
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-md-12 col-sm-12">
                            <div class="alert alert-dark outline fade show" role="alert">
                                <strong>Información!</strong> Si es solo imagen, por favor llenar Titulo y Descripción.
                                </button>
                             </div>
                        </div>
                    </div>
                    <form class="theme-form mega-form" action="{{ route('publicaciones.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Titulo (*)</label>
                                <input name="title" type="text" class="form-control" value="{{ $post->title }}"/>
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <label class="form-label">Descripcíon</label>
                                <input name="description" type="text" class="form-control" value="{{ $post->description }}"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12 col-sm-12">
                                <label class="form-label">Contenido</label>
                                <textarea name="content" type="text" class="form-control">{{ $post->content }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12 col-sm-12">
                                <label class="form-label">Imagen</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-6">
                                <label class="form-label">Documentos</label>
                                <input type="file" multiple name="docs[]" id="docs" class="form-control">
                            </div>
                            <div class="mb-3 col-md-6 col-sm-6">
                                <label class="form-label">Autor</label>
                                <input type="text" name="autor" id="autor" class="form-control" value="{{ $post->author }}">
                            </div>
                        </div>
                    <hr class="mt-4 mb-4">
                        <div class="col-auto">
                            <button class="btn btn-primary btn-md" type="submit">Editar</button>
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
