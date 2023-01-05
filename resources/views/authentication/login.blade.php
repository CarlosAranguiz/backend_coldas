@extends('layouts.authentication.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-12 p-0">
         <div class="login-card">
            <div>
               <div><a class="logo" href="{{ route('loginview') }}"><img class="img-fluid for-light" width="200px" height="200px" src="{{asset('assets/images/logo/logo_rad_solo.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div>
               <div class="login-main">
                  <form class="theme-form" method="POST" action="{{ route('loginpost') }}">
                     @csrf
                     <h4>Ingresa a tu cuenta!</h4>
                     <p>Coloca tu email y contraseña para entrar</p>
                     <div class="form-group">
                        <label class="col-form-label">Correo Electrónico</label>
                        <input class="form-control" type="email" name="email" required placeholder="Correo electrónico">
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input class="form-control" type="password" name="password" required placeholder="*********">
                     </div>
                     <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block" type="submit">Ingresar</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection