<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'Nombre' => $this->name,
            'Email' => $this->email,
            'rol_id' => $this->rol_id,
            'Rol' => $this->rol,
            'position_id' => $this->position_id,
            'Puesto' => $this->position
        ];
    }
}
