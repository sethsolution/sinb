<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $table = 'cites.catalogo_estado';
    protected $primaryKey = 'itemId';
    const CREATED_AT = 'dateCreate';
    const UPDATED_AT = 'dateUpdate';
}
