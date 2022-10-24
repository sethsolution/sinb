<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cite extends Model
{
    use HasFactory;
    protected $table = 'cites.cites';
    protected $primaryKey = 'itemId';
    //public $timestamps = false;

    const CREATED_AT = 'dateCreate';
    const UPDATED_AT = 'dateUpdate';

    public function getPublishedAtAttribute(){
        return $this->dateCreate->format('d/m/Y');
    }

    public function estado(){
        return $this->belongsTo(Estado::class,'estado_id','itemId');
    }
    public function tipo_documento(){
        return $this->belongsTo(Tipodocumento::class,'tipo_documento_id','itemId');
    }


}
