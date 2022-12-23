<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CiteEspecie extends Model
{
    use HasFactory;
    protected $table = 'cites.cites_especie';
    public function cite(){
        return $this->belongsTo(Cite::class,'cites_id','id');
    }
}
