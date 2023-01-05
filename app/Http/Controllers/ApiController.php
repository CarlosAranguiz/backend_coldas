<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        
    }


    public function carrera($id)
    {
        $carreras = Carrera::where(['id_universidad' => $id])->get();
        $response['data'] = $carreras;
        return $response;
    }
}
