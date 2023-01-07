<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Historial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HistorialController extends Controller
{
    public function index()
    {
        $historiales = Historial::orderBy('created_at','desc')->get();
        return view('administracion.historial.index')->with(['historiales' => $historiales]);
    }

    public function limpiarDispositivo(Request $request)
    {
        $alumno = User::where(['rut' => $request->rutAlumno])->get()->first();
        Device::where(['usuarioId' => $alumno->id])->delete();
        Session::flash('message','Dispositivo liberado con exito');
        Session::flash('alert','alert alert-success');
        return redirect()->back();
    }
}
