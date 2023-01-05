<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Practica;
use App\Models\QRModel;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PracticaController extends Controller
{
    public function practicaActiva()
    {
        $practica_activa = Practica::where(['usuarioId' => auth()->user()->id])
        ->where('hora_registro_termino',null)
        ->where('fecha_inicio','>=',Carbon::today())
        ->orderBy('fecha_inicio','asc')
        ->get()->first();
        return response()->json(['ok'=>true,'practica' => $practica_activa]);
    }

    public function obtenerHistorial()
    {
        $historial = Practica::where('usuarioId',auth()->user()->id)->where('hora_registro_termino','!=',null)->orderBy('fecha_inicio')->get();
        $response['ok'] = true;
        $response['historial'] = $historial;
        return $response;
    }


    static function distance($lat1, $lng1, $lat2, $lng2) {
        $lat1 = $lat1 * (pi() / 180);
        $lng1 = $lng1 * (pi() / 180);
        $lat2 = $lat2 * (pi() / 180);
        $lng2 = $lng2 * (pi() / 180);
      
        $deltaLat = $lat2 - $lat1;
        $deltaLng = $lng2 - $lng1;
      
        $a = sin($deltaLat / 2)**2 + cos($lat1) * cos($lat2) * sin($deltaLng / 2)**2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
      
        return 6371 * $c * 1000;
      }
      


    public function marcarAsistencia(Request $request)
    {
        $request->validate([
            'codigoqr' => 'required'
        ],[
            'codigoqr.required' => 'Debe ingresar un codigo'
        ]);
        $usuario = User::find(auth()->user()->id);
        $device = Device::where(['usuarioId' => $usuario->id])->get()->first();
        if($device != null){
            if($device->imei == $request->id){
                $parts = explode("+", $request->codigoqr);
                $codigo = QRModel::where('texto_qr',$parts[0])->get()->first();
                if(hash_equals($parts[1],$codigo->texto_encriptado)){
                    $settings = Setting::all()->first();
                    $practica_activa = Practica::where(['usuarioId' => auth()->user()->id])
                    ->where('hora_registro_termino',null)
                    ->where('fecha_inicio','>=',Carbon::today())
                    ->orderBy('fecha_inicio','asc')
                    ->get()->first();
            
                    $fechaPractica = $practica_activa->fecha_inicio;
                    $fecha = Carbon::parse($fechaPractica);
                    $today = Carbon::now();
                    if($today->toDateString() === $fecha->toDateString()){
                        $distance = $this->distance($usuario->latitud, $usuario->longitud, $settings->latitud, $settings->longitud);
                        if($distance < 2000){
                            if($practica_activa->hora_registro_inicio != null){
                                $practica_activa->hora_registro_termino = Carbon::now()->format('H:i');
                                $practica_activa->save();
                                $response['ok'] = true;
                                return $response;
                            }else{
                                $practica_activa->hora_registro_inicio = Carbon::now()->format('H:i');
                                $practica_activa->save();
                                $response['ok'] = true;
                                return $response;
                            }
                        }else{
                            $response['ok'] = false;
                            $response['msg'] = 'Debes estar en el recinto para marcar asistencia';
                            return $response;
                        }
                    }else{
                        $response['ok'] = false;
                        $response['msg'] = 'La practica no es el dia de hoy!';
                        return $response;
                    }
                }else{
                    $response['ok'] = false;
                    $response['msg'] = 'El codigo no es valido';
                    return $response;
                }
            }else{
                $response['ok'] = false;
                $response['msg'] = 'Este dispositivo no esta registrado en tu cuenta';
                return $response;
            }
        }else{
            Device::create([
                'imei' => $request->id,
                'usuarioId' => $usuario->id,
                'marca' => $request->marca,
                'modelo' => $request->modelo,
                'sistema' => $request->sistema
            ]);
            $parts = explode("+", $request->codigoqr);
            $codigo = QRModel::where('texto_qr',$parts[0])->get()->first();
            if(hash_equals($parts[1],$codigo->texto_encriptado)){
                $settings = Setting::all()->first();
                $practica_activa = Practica::where(['usuarioId' => auth()->user()->id])
                ->where('hora_registro_termino',null)
                ->where('fecha_inicio','>=',Carbon::today())
                ->orderBy('fecha_inicio','asc')
                ->get()->first();
        
                $fechaPractica = $practica_activa->fecha_inicio;
                $fecha = Carbon::parse($fechaPractica);
                $today = Carbon::now();
                if($today->toDateString() === $fecha->toDateString()){
                    $distance = $this->distance($usuario->latitud, $usuario->longitud, $settings->latitud, $settings->longitud);
                    if($distance < 2000){
                        if($practica_activa->hora_registro_inicio != null){
                            $practica_activa->hora_registro_termino = Carbon::now()->format('H:i');
                            $practica_activa->save();
                            $response['ok'] = true;
                            return $response;
                        }else{
                            $practica_activa->hora_registro_inicio = Carbon::now()->format('H:i');
                            $practica_activa->save();
                            $response['ok'] = true;
                            return $response;
                        }
                    }else{
                        $response['ok'] = false;
                        $response['msg'] = 'Debes estar en el recinto para marcar asistencia';
                        return $response;
                    }
                }else{
                    $response['ok'] = false;
                    $response['msg'] = 'La practica no es el dia de hoy!';
                    return $response;
                }
            }else{
                $response['ok'] = false;
                $response['msg'] = 'El codigo no es valido';
                return $response;
            }
        }
    }
}
