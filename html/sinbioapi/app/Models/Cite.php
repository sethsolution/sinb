<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cite extends Model
{
    use HasFactory;
    protected $table = 'cites.cites';

    public function estado(){
        return $this->belongsTo(CiteEstado::class,'estado_id','id');
    }
    public function proposito(){
        return $this->belongsTo(CiteProposito::class,'proposito_id','id');
    }
    public function tipoDocumento(){
        return $this->belongsTo(CiteTipoDocumento::class,'tipo_documento_id','id');
    }
}
