<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CiteEspecieResource extends JsonResource
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
            'id' => $this->itemId,
            'especie' => [
                'id' => $this->especie->itemId,
                'scientificname' => $this->especie->nombre,
                'commonnames' => $this->especie->nombre_comun
            ],
            'description' => $this->descripcion,
            'origen_id' => $this->origen_id,

            'origen'=>[
                'id' => $this->origen->itemId,
                'sigla' => $this->origen->sigla,
                'name' => $this->origen->nombre,
            ],

            'cantidad' => $this->cantidad,
            'unidad' => $this->unidad->unidad,
            'country_of_origin' => [
                'id' => $this->pais->itemId,
                'name' => $this->pais->nombre,
                'code' => $this->pais->sigla
            ],
        ];
    }
}
