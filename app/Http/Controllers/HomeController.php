<?php

namespace App\Http\Controllers;

use App\Models\Practica;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $today = Carbon::today();
        $practicas = Practica::where('fecha_inicio',$today->toDateString())->with(['usuario'])->get();

        return view('dashboard.index')->with(['practicas' => $practicas]);
    }

    public function politicas()
    {
        return view('administracion.politicas.index');
    }
}
