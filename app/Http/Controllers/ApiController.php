<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Carrera;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        $carrera = Carrera::where(['nombre_carrera' => 'Visita'])->get()->first();
        $alumno = User::create([
            'rut' => null,
            'email' => $request->email,
            'nombre' => $request->nombre,
            'apellido_paterno' => null,
            'apellido_materno' => null,
            'nombre_social' => null,
            'id_carrera' => $carrera->id,
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

    public function subirImagen(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $request->validate([
            'imagen' => 'required|file|image|mimes:jpeg,png,gif,jpg|max:4096',
        ]);
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $nombre = date('dmYHmi_') . mt_rand() . '_' . $user->id . '.jpg';
            $storage = Storage::putFileAs('imagenes/user/' . $user->id, $image, $nombre);
            $url = Storage::url($storage);
            $user->profile_photo_path = $url;
            $user->save();
            // dd($storage, $url);
            $response["ok"] = true;
            $response["msg"] = 'Imagen subida correctamente.';
            $response["foto_perfil"] = $url;
            return $response;
        } else {
            $response["ok"] = false;
            $response["message"] = 'Debe subir una imagen.';
            return $response;
        }
    }


    public function carrera($id)
    {
        $carreras = Carrera::where(['id_universidad' => $id])->get();
        $response['data'] = $carreras;
        return $response;
    }
}
