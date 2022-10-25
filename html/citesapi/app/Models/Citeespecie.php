<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citeespecie extends Model
{
    use HasFactory;
    protected $table = 'cites.cites_especie';
    protected $primaryKey = 'itemId';
    const CREATED_AT = 'dateCreate';
    const UPDATED_AT = 'dateUpdate';

    public function cites(){
        return $this->belongsTo(Cite::class,'cites_id','itemId');
    }

    public function especie(){
        return $this->belongsTo(Especie::class,'especie_id','itemId');
    }
    public function pais(){
        return $this->belongsTo(Pais::class,'pais_id','itemId');
    }

    public function origen(){
        return $this->belongsTo(Origen::class,'origen_id','itemId');
    }

    public function unidad(){
        return $this->belongsTo(Unidad::class,'unidad_id','itemId');
    }

}
