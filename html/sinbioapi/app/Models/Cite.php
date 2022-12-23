<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cite extends Model
{
    use HasFactory;
    protected $table = 'cites.cites';

    public function estado(){
        return $this->belongsTo(CatalogoCitesEstado::class,'estado_id','id');
    }

    public function proposito(){
        return $this->belongsTo(CatalogoCitesProposito::class,'proposito_id','id');
    }

    public function tipoDocumento(){
        return $this->belongsTo(CatalogoCiteTipoDocumento::class,'tipo_documento_id','id');
    }
    public function especie(){
        //return $this->hasMany(CiteEspecie::class,'cite_id','id');
        return $this->hasMany(CiteEspecie::class,'cites_id','id');
    }

}
