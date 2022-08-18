<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;
    protected $table = 'core.app';
    protected $primaryKey = 'id';
    //public $timestamps = false;

    public function appGroups(){
        return $this->hasMany(AppGroup::class);
    }

    public function groupTo(){
        return $this->belongsTo(Group::class); //group_id
    }

}
