<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CatalogoCiteEspecieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'scientificname' => $this->nombre,
            'commonnames' => $this->nombre_comun,
            'description' => $this->descripcion,
            'type' => $this->tipo,
        ];
    }
}
