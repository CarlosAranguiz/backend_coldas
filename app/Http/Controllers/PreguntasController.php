<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\QuestionOption;
use App\Models\Respuesta;
use App\Models\RespuestaAlumno;
use App\Models\Resultado;
use Illuminate\Http\Request;

class PreguntasController extends Controller
{


    public function getPreguntas()
    {
        // $preguntas = resource_path('json/preguntas.json');
        // $json = json_decode(file_get_contents($preguntas), true);
        // foreach ($json as $pregunta) {
        //     $question = Pregunta::create([
        //         'pregunta' => $pregunta['question'],
        //     ]);

        //     if(array_key_exists('question_opt',$pregunta)){
        //         foreach ($pregunta['question_opt'] as $question_opt) {
        //             QuestionOption::create([
        //                 'pregunta_id' => $question->id,
        //                 'question_opt' => $question_opt,
        //             ]);
        //         }
        //     }

        //     foreach ($pregunta['options'] as $respuesta) {
        //         Respuesta::create([
        //             'pregunta_id' => $question->id,
        //             'respuesta' => $respuesta['text'],
        //             'correcta' => $respuesta['isCorrect'],
        //         ]);
        //     }
        // }
        $allPreguntas = Pregunta::with(['respuestas','opciones'])->where('examen_id','==',0)->get();

        return response()->json($allPreguntas);
    }

    public function terminar_prueba_evaluacion(Request $request) {

        $respuestas = $request->all();
        $data = json_decode($respuestas['data'],true);
        $fundamentos = json_decode($respuestas['justificaciones'],true);
        foreach ($data as $value) {
            RespuestaAlumno::create([
                'alumno_id' => auth()->user()->id,
                'respuesta_id' => $value,
            ]);
        }

        foreach($fundamentos as $key => $justificacion){
            if(array_key_exists($key,$fundamentos)){
                $respuestaAlumno = RespuestaAlumno::where('alumno_id',auth()->user()->id)->where('respuesta_id',$key)->first();
                if($respuestaAlumno){
                    $respuestaAlumno->fundamento = $justificacion;
                    $respuestaAlumno->save();
                }else{
                    RespuestaAlumno::create([
                        'alumno_id' => auth()->user()->id,
                        'respuesta_id' => $key,
                        'fundamento' => $justificacion,
                    ]);
                }
            }
        }

        return response()->json(['message' => 'Prueba terminada','ok' => true]);
    }

    public function terminar_prueba(Request $request) {
        $respuestas = $request->all();
        foreach ($respuestas as $key => $value) {
            RespuestaAlumno::create([
                'alumno_id' => auth()->user()->id,
                'respuesta_id' => $value,
            ]);
        }

        $respuestasAlumnos = RespuestaAlumno::where('alumno_id',auth()->user()->id)->get();
        $correctas = 0;
        $incorrectas = 0;
        foreach ($respuestasAlumnos as $respuestaAlumno) {
            if($respuestaAlumno->respuesta->correcta){
                $correctas++;
            }else{
                $incorrectas++;
            }
        }

        $resultado = Resultado::create([
            'user_id' => auth()->user()->id,
            'buenas' => $correctas,
            'malas' => $incorrectas,
            'total' => $this->mapa[''.$correctas.''],
            'aprobado' => $correctas >= 23 ? true : false,
        ]);

        return response()->json(['message' => 'Prueba terminada','resultado' => $resultado]);

    }

    public function getPreguntasEvaluacion()
    {
        // $preguntas = resource_path('json/evaluacion.json');
        // $json = json_decode(file_get_contents($preguntas), true);
        // foreach ($json['preguntas'] as $pregunta) {
        //     $question = Pregunta::create([
        //         'pregunta' => $pregunta['texto'],
        //         'examen_id' => '1'
        //     ]);

        //     if(array_key_exists('opciones',$pregunta)){
        //         foreach ($pregunta['opciones'] as $respuesta) {
        //             Respuesta::create([
        //                 'pregunta_id' => $question->id,
        //                 'respuesta' => $respuesta,
        //                 'correcta' => true,
        //             ]);
        //         }
        //     }


        // }
        $allPreguntas = Pregunta::with(['respuestas','opciones'])->where('examen_id',1)->get();

        return response()->json($allPreguntas);
    }



    public $mapa = [
        '0' => '1.0',
        '1' => '1.1',
        '2' => '1.3',
        '3' => '1.4',
        '4' => '1.5',
        '5' => '1.7',
        '6' => '1.8',
        '7' => '1.9',
        '8' => '2.1',
        '9' => '2.2',
        '10' => '2.3',
        '11' => '2.4',
        '12' => '2.6',
        '13' => '2.7',
        '14' => '2.8',
        '15' => '3.0',
        '16' => '3.1',
        '17' => '3.2',
        '18' => '3.4',
        '19' => '3.5',
        '20' => '3.6',
        '21' => '3.8',
        '22' => '3.9',
        '23' => '4.0',
        '24' => '4.2',
        '25' => '4.4',
        '26' => '4.6',
        '27' => '4.8',
        '28' => '5.0',
        '29' => '5.2',
        '30' => '5.4',
        '31' => '5.6',
        '32' => '5.8',
        '33' => '6.0',
        '34' => '6.2',
        '35' => '6.4',
        '36' => '6.6',
        '37' => '6.8',
        '38' => '7.0',
    ];

}
