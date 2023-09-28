<?php

namespace App\Exports;

use App\Models\Pregunta;
use App\Models\RespuestaAlumno;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExamAnswersExport implements FromCollection,WithHeadings
{
    protected $examenId;

    public function __construct($examenId)
    {
        $this->examenId = $examenId;
    }

    public function collection()
    {
        // return RespuestaAlumno::whereHas('respuesta.pregunta', function ($query) {
        //     $query->where('examen_id', $this->examenId);
        // })
        // ->with(['respuesta', 'respuesta.pregunta', 'alumno'])
        // ->get()
        // ->map(function ($respuestaAlumno) {
        //     return [
        //         'Alumno_ID' => $respuestaAlumno->alumno->id,
        //         'Alumno_Name' => $respuestaAlumno->alumno->nombre, // Asumiendo que el modelo Alumno tiene un campo 'name'
        //         'Pregunta_ID' => $respuestaAlumno->respuesta->id,
        //         'Pregunta_Text' => $respuestaAlumno->respuesta->pregunta->pregunta,
        //         'Respuesta' => $respuestaAlumno->respuesta->respuesta,
        //         'Fundamento' => $respuestaAlumno->fundamento,
        //     ];
        // });

        // $preguntasConRespuestas = Pregunta::leftJoin('respuestas', 'preguntas.id', '=', 'respuestas.pregunta_id')
        // ->leftJoin('respuesta_alumnos', function ($join) {
        //     $join->on('respuestas.id', '=', 'respuesta_alumnos.respuesta_id');
        // })
        // ->leftJoin('users','respuesta_alumnos.alumno_id','=','users.id')
        // ->where('preguntas.examen_id', $this->examenId)
        // ->select('preguntas.*', 'respuestas.respuesta as respuesta_text', 'respuesta_alumnos.*','users.*')
        // ->get();

        $preguntasConRespuestas = Pregunta::leftJoin('respuestas', 'preguntas.id', '=', 'respuestas.pregunta_id')
        ->leftJoin('respuesta_alumnos', function($join) {
            $join->on('respuestas.id', '=', 'respuesta_alumnos.respuesta_id');
        })
        ->leftJoin('users', 'respuesta_alumnos.alumno_id', '=', 'users.id')
        ->select('preguntas.id', 'preguntas.pregunta', DB::raw('MAX(respuestas.respuesta) as respuesta_text'), DB::raw('MAX(respuesta_alumnos.fundamento) as fundamento'), DB::raw('MAX(users.nombre) as user_name'))
        ->where('preguntas.examen_id', $this->examenId)
        ->groupBy('preguntas.id', 'preguntas.pregunta')
        ->get();
        $resultados = $preguntasConRespuestas->map(function ($item){
            return [
                // 'Pregunta_ID' => $numeroPregunta,
                'Pregunta_Text' => $item->pregunta,
                'Respuesta_Text' => $item->respuesta_text ?? 'Sin respuesta seleccionada',
                'Fundamento' => $item->fundamento ?? 'Sin fundamento',
                'Usuario' => $item->user_name ?? 'Desconocido',
            ];
        });
        return $resultados;
    }

    public function headings(): array
    {
        return [
            'Pregunta_Text',
            'Respuesta',
            'Fundamento',
            'Alumno'
        ];
    }
}
