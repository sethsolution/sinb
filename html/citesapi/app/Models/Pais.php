<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;
    protected $table = 'cites.catalogo_pais';
    protected $primaryKey = 'itemId';
    const CREATED_AT = 'dateCreate';
    const UPDATED_AT = 'dateUpdate';

}
