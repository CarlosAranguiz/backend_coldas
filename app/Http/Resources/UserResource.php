<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $fecha_nacimiento = date('d-m-Y', strtotime($this->fecha_nacimiento));
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'nombre_social' => $this->nombre_social,
            'email' => $this->email,
            'fecha_nacimiento' => $fecha_nacimiento,
            'telefono' => $this->telefono,
            'carrera' => $this->carrera->nombre_carrera,
            'universidad' => $this->carrera->universidad,
            'foto_perfil' => $this->profile_photo_path,
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
        ];
    }
}
