<?php

namespace App\Imports;

use App\Models\Carrera;
use App\Models\Practica;
use App\Models\Universidad;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AlumnosImport implements ToCollection,WithHeadingRow
{
    private int $universidad;

    public function __construct($universidad) {
        $this->universidad = $universidad;
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $rut = str_replace(".", "", $row['rut']);
            $user = User::where(['rut' => $rut])->get()->first();
            if($user == null){
                $carrera = Carrera::where(['id_universidad' => $this->universidad,'nombre_carrera'=> $row['carrera']])->get()->first();
                if($carrera != null){
                    $fechaInicio = Date::excelToDateTimeObject($row['fecha_inicio']);
                    $fechaTermino = Date::excelToDateTimeObject($row['fecha_termino']);
                    $diferenciaEntreDias = date_diff($fechaInicio,$fechaTermino);
                    $diasPractica = $diferenciaEntreDias->days + 1;
                    $usuario = User::create([
                        'rut' => $rut,
                        'nombre' => $row['nombre'],
                        'apellido_paterno' => $row['apellido_paterno'],
                        'apellido_materno' => $row['apellido_materno'],
                        'nombre_social' => null,
                        'email' => $row['correo'],
                        'fecha_nacimiento' => null,
                        'telefono' => $row['fono_alumno'],
                        'password' => Hash::make(substr($rut,0,6).'...'),
                        'id_carrera' => $carrera->id
                    ]);
                    for ($i=0; $i < $diasPractica; $i++) {
                        $endParse = Carbon::parse($fechaInicio);
                        $fechaFinal = $endParse->addDays($i);
                        $fechax = $i == 0 ? $endParse->format('Y-m-d') : $fechaFinal->format('Y-m-d');
                        $practica = Practica::where(['fecha_inicio' => $fechax,'fecha_termino' => $fechax,'usuarioId' => $usuario->id])->get()->first();
                        if($practica == null){
                            Practica::create([
                                'usuarioId' => $usuario->id,
                                'campo_clinico' => $row['campo_clinico_solicitado'],
                                'nivel_cursado' => $row['nivel_que_cursa'],
                                'tipo_practica' => $row['tipo_de_practica'],
                                'nombre_docente' => $row['docente'],
                                'telefono_docente' => $row['telefono_docente'],
                                'fecha_inicio' => $i == 0 ? $endParse->format('Y-m-d') : $fechaFinal->format('Y-m-d'),
                                'fecha_termino' => $i == 0 ? $endParse->format('Y-m-d') : $fechaFinal->format('Y-m-d'),
                                'hora_inicio' => Date::excelToDateTimeObject($row['desde'])->format('H:i'),
                                'hora_termino' => Date::excelToDateTimeObject($row['hasta'])->format('H:i')
                            ]);
                        }
                    }
                }
            }else{
                $carrera = Carrera::where(['id_universidad' => $this->universidad,'nombre_carrera'=> $row['carrera']])->get()->first();
                if($carrera != null){
                    $fechaInicio = Date::excelToDateTimeObject($row['fecha_inicio']);
                    $fechaTermino = Date::excelToDateTimeObject($row['fecha_termino']);
                    $diferenciaEntreDias = date_diff($fechaInicio,$fechaTermino);
                    $diasPractica = $diferenciaEntreDias->days + 1;
                    for ($i=0; $i < $diasPractica; $i++) { 
                        $endParse = Carbon::parse($fechaInicio);
                        $fechaFinal = $endParse->addDays($i);
                        $fechax = $i == 0 ? $endParse->format('Y-m-d') : $fechaFinal->format('Y-m-d');
                        $practica = Practica::where(['fecha_inicio' => $fechax,'fecha_termino' => $fechax,'usuarioId' => $user->id])->get()->first();
                        if($practica == null){
                            Practica::create([
                                'usuarioId' => $user->id,
                                'campo_clinico' => $row['campo_clinico_solicitado'],
                                'nivel_cursado' => $row['nivel_que_cursa'],
                                'tipo_practica' => $row['tipo_de_practica'],
                                'nombre_docente' => $row['docente'],
                                'telefono_docente' => $row['telefono_docente'],
                                'fecha_inicio' => $i == 0 ? $endParse->format('Y-m-d') : $fechaFinal->format('Y-m-d'),
                                'fecha_termino' => $i == 0 ? $endParse->format('Y-m-d') : $fechaFinal->format('Y-m-d'),
                                'hora_inicio' => Date::excelToDateTimeObject($row['desde'])->format('H:i'),
                                'hora_termino' => Date::excelToDateTimeObject($row['hasta'])->format('H:i')
                            ]);
                        }
                    }
                }
            }
        }
    }
}
