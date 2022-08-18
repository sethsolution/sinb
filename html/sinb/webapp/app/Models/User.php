<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'core.user';
    protected $primaryKey = 'id';
    //public $timestamps = false;

    protected $fillable = [
        'ip',
        'session',
        'login_date'
    ];

    public function userModules(){
        return $this->hasMany(UserModule::class);
    }

}
