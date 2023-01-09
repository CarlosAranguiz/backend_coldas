<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Imports\AlumnosImport;
use App\Models\Practica;
use App\Models\Universidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function loginView()
    {
        return view('authentication.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required','string'],
            'password' => ['required','string']
        ],['email.required' => 'Debe llenar este campo','password.required' => 'Debe ingresar su contraseña']);
        $user = User::where(['email' => $request->email])->first();
        if($user && Hash::check($request->password, $user->password)){
            Auth::login($user);
            return redirect()->route('dashboard');
        }else{
            Session::flash('message','Credenciales incorrectas, intenten nuevamente');
            return redirect()->back();
        }
    }

    public function alumnos()
    {
        $usuarios = User::where('tipo',2)->get();
        $universidades = Universidad::all();
        return view('administracion.alumnos.list')->with(['usuarios' => $usuarios,'universidades' => $universidades]);
    }

    public function storeForm(Request $request)
    {
        $universidades = Universidad::all();
        return view('administracion.alumnos.create')->with(['universidades' => $universidades]);
    }

    public function userdetail($id)
    {
        $usuario = User::find($id);
        $universidades = Universidad::all();
        return view('administracion.alumnos.edit')->with(['usuario' => $usuario,'universidades' => $universidades]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'rut' => ['required','string','max:12'],
            'nombre' => ['required','string'],
            'apellido_paterno' => ['required','string'],
            'apellido_materno' => ['required','string'],
            'email' => ['required','string','unique:users'],
            'telefono' => ['required','string','max:9']
        ],[
            'rut.required' => 'Debe ingresar el rut',
            'rut.max' => 'Debe tener 12 caracteres',
            'nombre.required' => 'Debe ingresar el nombre',
            'apellido_paterno.required' => 'Debe ingresar el apellido paterno',
            'apellido_materno.required' => 'Debe ingresar el apellido materno',
            'email.required' => 'Debe ingresar un correo',
            'telefono.required' => 'Debe ingresar un telefono'
        ]);
            $alumno = User::create([
                'rut' => $request->rut,
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'nombre_social' => $request->nombre_social ?? null,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'id_carrera' => $request->carrera,
                'password'=> Hash::make(Str::limit($request->rut,6)),
            ]);
            Session::flash('message','Alumno creado con exito!');
            Session::flash('alert','alert alert-success');
            return redirect()->route('alumnos.list');
    }

    public function update(Request $request,$id)
    {
            User::find($id)->update([
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'nombre_social' => $request->nombre_social ?? '',
                'email' => $request->email,
                'telefono' => $request->telefono,
                'id_carrera' => $request->carrera
            ]);
            Session::flash('message','Alumno modificado con exito!');
            return redirect()->back();
    }


    public function importAlumnos(Request $request)
    {
        if($request->hasFile('excel')){
            Excel::import(new AlumnosImport($request->universidadImportar),$request->file('excel'));
            Session::flash('msg','Documento importado con exito!');
            Session::flash('class','alert-success');
            return back();
        }
    }

    public function loginApi(Request $request)
    {
        $request->validate([
            'rut' => ['required','string'],
            'password' => ['required'],
            'latitud' => ['required'],
            'longitud' => ['required']
        ],['rut.required' => 'Debe ingresar un rut','password.required' => 'Debe ingresar una contraseña']);

        $user = User::where(['rut' => $request->rut])->first();
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
            'rut' => ['required','string','max:12'],
            'nombre' => ['required','string'],
            'apellido_paterno' => ['required','string'],
            'apellido_materno' => ['required','string'],
            'email' => ['required','string','unique:users'],
            'password' => ['required','confirmed'],
        ],[
            'rut.required' => 'Debe ingresar el rut',
            'rut.max' => 'Debe tener 12 caracteres',
            'nombre.required' => 'Debe ingresar el nombre',
            'apellido_paterno.required' => 'Debe ingresar el apellido paterno',
            'apellido_materno.required' => 'Debe ingresar el apellido materno',
            'email.required' => 'Debe ingresar un correo',
            'password.confirmed' => 'Las contraseñas no coinciden'
        ]);
        $alumno = User::create([
            'rut' => $request->rut,
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'nombre_social' => $request->nombre_social ?? null,
            'email' => $request->email,
            'id_carrera' => 10,
            'password'=> Hash::make($request->password),
        ]);
        $usuario = new UserResource($alumno);
        $response['ok'] = true;
        $response['usuario'] = $usuario;
        $response['token'] = $usuario->createToken('rad')->plainTextToken;
        return response($response);
    } 

    

    public function delete(Request $request)
    {
        User::find($request->idEliminar)->delete();
        Practica::where(['usuarioId' => $request->idEliminar])->delete();
        Session::flash('message','Alumno creado con exito!');
        Session::flash('alert','alert alert-success');
        return redirect()->back();
    }

}
