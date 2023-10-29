<?php

namespace App\Http\Controllers;

use App\Exports\ExamAnswersExport;
use App\Models\InformacionUtil;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\RespuestaAlumno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InformacionUtilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $decalogo = InformacionUtil::where('titulo', 'decalogo')->first();
        return view('administracion.config.index')->with(['decalogo' => $decalogo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InformacionUtil  $informacionUtil
     * @return \Illuminate\Http\Response
     */
    public function show(InformacionUtil $informacionUtil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InformacionUtil  $informacionUtil
     * @return \Illuminate\Http\Response
     */
    public function edit(InformacionUtil $informacionUtil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InformacionUtil  $informacionUtil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InformacionUtil $informacionUtil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InformacionUtil  $informacionUtil
     * @return \Illuminate\Http\Response
     */
    public function destroy(InformacionUtil $informacionUtil)
    {
        //
    }

    public function getDecalogo()
    {
        $decalogo = InformacionUtil::where('titulo', 'decalogo')->first();
        return response()->json($decalogo);
    }

    public function SaveDecalogo(Request $request) {
        $decalogo = InformacionUtil::where('titulo', 'Decalogo')->first();
        if ($request->hasFile('decalogo')) {
            $image = $request->file('decalogo');
            $nombre = date('dmYHmi_') . mt_rand() . '_decalogo.'. $image->getClientOriginalExtension();
            $storage = Storage::putFileAs('documentos/decalogo', $image, $nombre);
            $url = Storage::url($storage);
            $decalogo->url = $url;
            $decalogo->save();
            Session::flash('msg','Recurso creado con exito!');
            return redirect()->back();
        }else{
            Session::flash('msg','Debe subir un archivo.');
            return redirect()->back();
        }
    }

    public function Informes()
    {
        return view('administracion.config.informes');
    }

    public function informesExcel($id)
    {
        $tituloExamen = $id == 0 ? 'evaluacion_inicial' : 'evaluacion_final';
        return Excel::download(new ExamAnswersExport($id), $tituloExamen.".xlsx");
    }

    public function prueba()
    {
        $alumnos = User::all();
        $preguntas = Pregunta::all();

        $informe = [];

        foreach ($alumnos as $alumno) {
            $row = [
                'nombre_alumno' => $alumno->nombre, // Ajusta el campo de nombre del alumno.
            ];

            foreach ($preguntas as $pregunta) {
                $respuestaAlumno = RespuestaAlumno::where('alumno_id', $alumno->id)
                    ->whereHas('respuesta', function ($query) use ($pregunta) {
                        $query->where('pregunta_id', $pregunta->id);
                    })
                    ->first();

                if ($respuestaAlumno) {
                    $row[$pregunta->pregunta] = $respuestaAlumno->respuesta->respuesta; // Ajusta el campo de respuesta.
                } else {
                    $row[$pregunta->pregunta] = 'No existe registro';
                }
            }

            $informe[] = $row;
        }
        dd($informe);
    return view('administracion.config.prueba', ['informe' => $informe]);
    }

}
