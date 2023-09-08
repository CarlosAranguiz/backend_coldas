<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Models\Post  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $fecha_nacimiento = date('d-m-Y', strtotime($this->fecha_nacimiento));
        return [
            'id' => $this->id,
            'nombre' => $this->nombre ?? 'Sin Nombre',
            'apellido_paterno' => $this->apellido_paterno ?? '',
            'apellido_materno' => $this->apellido_materno ?? '',
            'nombre_social' => $this->nombre_social ?? '',
            'email' => $this->email,
            'fecha_nacimiento' => $fecha_nacimiento ?? 'Sin Fecha de Nacimiento',
            'telefono' => $this->telefono ?? 'Sin Teléfono',
            'carrera' => $this->carrera->nombre_carrera ?? 'Sin Carrera',
            'universidad' => $this->carrera->universidad ?? 'Sin Universidad',
            'foto_perfil' => $this->profile_photo_path,
        ];
    }
}
