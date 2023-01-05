<?php

namespace App\Http\Controllers;

use App\Models\QRModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function index()
    {
        $codigos = QRModel::all();
        return view('administracion.codigos.list',['codigos' => $codigos]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'texto' => 'required'
        ],[
            'texto.required' => 'Debe ingresar un codigo para generar el QR'
        ]);
        $texto_encriptado = Hash::make($request->texto);
        QRModel::create([
            'texto_qr' => $request->texto,
            'texto_encriptado' => $texto_encriptado,
        ]);
        Session::flash('message','Codigo creado con exito!');
        Session::flash('class','alert alert-success');
        return redirect()->back();
    }

    public function verQR($id){
        $codigo = QRModel::find($id);
        return QrCode::size(256)->generate($codigo->texto_qr.'+'.$codigo->texto_encriptado); 
    }
}