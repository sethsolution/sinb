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

            'id' => $this->id,
            'fecha' => $this->fecha,
            'tipo_documento_id' => $this->tipo_documento_id,
            'numero_cites' => $this->numero_cites,
            'exportador' => $this->exportador,
            'destinatario' => $this->destinatario,
            'proposito_id' => $this->proposito_id,
            'fecha_valido' => $this->fecha_valido,
            'estado' => [
                'id' => $this->estado->id ?? null,
                'name' => $this->estado->nombre ?? null,
            ],
            'proposito' => [
                'id' => $this->proposito->id ?? null,
                'name' => $this->proposito->nombre ?? null,
                'sigla' => $this->proposito->sigla ?? null,
            ],
            'tipo_documento' => [
                'id' => $this->tipoDocumento->id ?? null,
                'name' => $this->tipoDocumento->nombre ?? null,
            ],
            'especie' => $this->especie,
        ];
    }
}
