<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppGroup extends Model
{
    use HasFactory;
    protected $table = 'core.app_group';
    protected $primaryKey = 'id';
    //public $timestamps = false;
    public function appModules(){
        return $this->hasMany(AppModule::class);
    }

    public function appTo(){
        return $this->belongsTo(App::class);
    }
}
