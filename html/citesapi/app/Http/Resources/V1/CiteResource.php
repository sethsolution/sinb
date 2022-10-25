<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CiteResource extends JsonResource
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
            'estado' => [
                'id' => $this->estado->itemId,
                'name' => $this->estado->nombre
            ],
            'tipo_documento' => [
                'id' => $this->tipo_documento->itemId,
                'name' => $this->tipo_documento->nombre
            ],
            'importador' => [
                'name' => $this->importador_nombre,
                'address' => $this->importador_direccion,
                'country_id' => $this->importacion_pais_id,
                'country_name' => $this->importador_pais->nombre,
                'country_sigla' => $this->importador_pais->sigla,
            ],
            'exportador' => [
                'name' => $this->importador_nombre,
                'address' => $this->importador_direccion,
                'country_id' => $this->exportador_pais_id,
                'country_name' => $this->exportador_pais->nombre,
                'country_sigla' => $this->exportador_pais->sigla,
            ],
            'especies' => CiteEspecieResource::collection($this->especies) ,
            'condiciones_especiales' => $this->condiciones_especiales,
            'created_at' => $this->published_at,
        ];
    }
}
