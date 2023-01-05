<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarreraController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required'],['nombre.required' => 'Debe ingresar el nombre de la carrera']);

        Carrera::create([
            'nombre_carrera' => $request->nombre,
            'id_universidad' => $request->id
        ]);

        Session::flash('message','Carrera creada con exito!');
        Session::flash('alert', 'alert-success');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        User::where(['id_carrera' => $request->idEliminar])->update(['id_carrera' => null]);
        Carrera::find($request->idEliminar)->delete();
        Session::flash('message','Carrera eliminada con exito!');
        Session::flash('alert', 'alert-success');
        return redirect()->back();
    }
}
