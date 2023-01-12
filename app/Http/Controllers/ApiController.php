<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Carrera;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function loginApi(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
            'latitud' => ['required'],
            'longitud' => ['required']
        ],['email.required' => 'Debe ingresar un correo electrónico','password.required' => 'Debe ingresar una contraseña']);

        $user = User::where(['email' => $request->email])->first();
        if($user && Hash::check($request->password, $user->password)){
            $user->latitud = $request->latitud;
            $user->longitud = $request->longitud;
            $user->save();
            $usuario = new UserResource($user);
            $response['usuario'] = $usuario;
            $response['token'] = $user->createToken('rad')->plainTextToken;
            return response($response,201);
        }else{
            $response['error'] = 'Credenciales incorrectas';
            return response($response,201);
        }
    }

    
    public function registroAlumno(Request $request)
    {
        $request->validate([
            'email' => ['required','string'],
            'nombre' => ['required','string'],
            'password' => ['required','confirmed'],
        ],[
            'email.required' => 'Debe ingresar el correo electrónico',
            'nombre.required' => 'Debe ingresar el nombre',
            'password.confirmed' => 'Las contraseñas no coinciden'
        ]);
        $alumno = User::create([
            'rut' => null,
            'email' => $request->email,
            'nombre' => $request->nombre,
            'apellido_paterno' => null,
            'apellido_materno' => null,
            'nombre_social' => null,
            'email' => null,
            'id_carrera' => 10,
            'password'=> Hash::make($request->password),
        ]);
        $usuario = new UserResource($alumno);
        $response['ok'] = true;
        $response['usuario'] = $usuario;
        $response['token'] = $usuario->createToken('rad')->plainTextToken;
        return response($response);
    } 

    public function borrarCuenta()
    {
        $usuario = User::find(auth()->user()->id);
        $usuario->delete();
        $response['ok'] = true;
        $response['msg'] = 'Cuenta eliminada con exito!';
    }


    public function carrera($id)
    {
        $carreras = Carrera::where(['id_universidad' => $id])->get();
        $response['data'] = $carreras;
        return $response;
    }
}
