<?php

namespace App\Imports;

use App\Models\Carrera;
use App\Models\Universidad;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UniversidadImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if($row['universidad'] != ''){
                $universidad = Universidad::where(['nombre_universidad' => $row['universidad']])->get()->first();
                if($universidad == null){
                    $nuevaUni = Universidad::create([
                        'nombre_universidad' => $row['universidad']
                    ]);
                    Carrera::create([
                        'id_universidad' => $nuevaUni->id,
                        'nombre_carrera' => $row['carrera']
                    ]);
                }else{
                    //SI LA UNIVERSIDAD EXISTE
                    $checkCarrera = Carrera::where([
                        'id_universidad' => $universidad->id,
                        'nombre_carrera' => $row['carrera']
                    ])->get()->first();
                    if($checkCarrera == null){
                        Carrera::create([
                            'id_universidad' => $universidad->id,
                            'nombre_carrera' => $row['carrera']
                        ]);
                    }
                }
            }
        }
    }
}
