<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModule extends Model
{
    use HasFactory;
    protected $table = 'core.user_module';
    protected $primaryKey = 'id';
    //public $timestamps = false;

    public function userTo(){
        return $this->belongsTo(User::class);
    }
}
