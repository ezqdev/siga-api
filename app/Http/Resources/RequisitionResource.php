<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequisitionResource extends JsonResource
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
            'Espacio' => " ID: {$this->space->id} - {$this->space->name}",
            'Bienes' => $this->estate ? " ID: {$this->estate->id} - {$this->estate->name}": 'N\A',
            'Servicos' => $this->service ? "ID: {$this->service->id} - {$this->service->name}": 'N\A',
            'Numero de requisicion' =>  $this->Num_requisitions ?? 'Sin requisicion'
        ];
    }
}
