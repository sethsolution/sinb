<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'core.group';
    protected $primaryKey = 'id';
    //public $timestamps = false;

    public function apps(){
        return $this->hasMany(App::class);
    }

}
