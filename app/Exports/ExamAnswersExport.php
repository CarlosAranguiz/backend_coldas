<?php

namespace App\Exports;

use App\Models\Pregunta;
use App\Models\RespuestaAlumno;
use App\Models\User;
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
        $alumnos = User::all();
        $preguntas = Pregunta::all();

        $informe = [];

        foreach ($alumnos as $alumno) {
            $row = [
                'nombre_alumno' => $alumno->nombre,
            ];

            foreach ($preguntas as $pregunta) {
                $respuestaAlumno = RespuestaAlumno::where('alumno_id', $alumno->id)
                    ->whereHas('respuesta', function ($query) use ($pregunta) {
                        $query->where('pregunta_id', $pregunta->id);
                    })
                    ->first();

                if ($respuestaAlumno) {
                    $row[$pregunta->pregunta] = $respuestaAlumno->respuesta->respuesta;
                } else {
                    $row[$pregunta->pregunta] = 'No existe registro';
                }

                if (!isset($row['fundamento'])) {
                    $row['fundamento'] = ''; // Inicializa el campo de fundamentación.
                }

                if ($respuestaAlumno) {
                    $row['fundamento'] = $respuestaAlumno->fundamento; // Agrega la fundamentación si existe respuesta.
                }
            }

            $informe[] = $row;
        }

        return collect($informe);
    }

    public function headings(): array
    {
        $preguntas = Pregunta::all();
        $headings = ['nombre_alumno'];

        foreach ($preguntas as $pregunta) {
            $headings[] = $pregunta->pregunta;
        }

        $headings[] = 'fundamento'; // Agrega el encabezado de la fundamentación.

        return $headings;
    }
}
