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
            'estado_id' => $this->estado_id
        ];
    }
}
