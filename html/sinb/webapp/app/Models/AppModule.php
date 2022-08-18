<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppModule extends Model
{
    use HasFactory;
    protected $table = 'core.app_module';
    protected $primaryKey = 'id';
    //public $timestamps = false;

    public function userModules(){
        return $this->hasMany(UserModule::class);
    }

    public function appGroup(){
        return $this->belongsTo(AppGroup::class);
    }
}
