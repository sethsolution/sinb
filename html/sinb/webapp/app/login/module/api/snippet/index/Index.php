<?PHP
namespace App\Login\Module\Api\Snippet\Index;
use Core\CoreResources;
use Core\Core;
use App\Models\User;

class Index extends CoreResources {

    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }
    public function auth(){
        if($_REQUEST["user"]!="" && $_REQUEST["password"]!="" && isset($_REQUEST["user"]) && isset($_REQUEST["password"])){
            $where = [
                ['username', '=', $_REQUEST["user"]],
                ['password', '=', $_REQUEST["password"]]
            ];
            $user = User::where($where)->get();

            if(count($user)==1){
                $res["res"] = 1;
                $res["msg"] = "OK";
                $id = $user[0]->id;
            }else{
                $res["res"] = 2;
                $res["msg"] = "User login details are incorrect";
            }
        }

        /**
         * Si los datos de acceso son correcto,
         * se realizar las siguientes acciones:
         * - Guarda log de ingreso en base de datos
         * - Guarda un log en archivo.
         */

        if($res["res"]==1){
            $aut = 1;
            $_SESSION["error"] = 0;
            $_SESSION["userv"] = $user[0]->toArray();
            $_SESSION["empresa"] = $_REQUEST["empresa"];
            $_SESSION["auth"] = true;
            //$sysLog->writeLog("login","enter","ok",$rec,"","user",$item["id"]);
            /**
             * Actualizamos los datos del usuario logueado
             */
            $rec = array();
            $rec["ip"] = Core::getIp();
            $rec["session"] = session_id();
            $rec['login_date'] = date('Y-m-d H:i:s');
            $userU = User::find($id);
            $userU->update($rec);
            $userU->save();
        }else{
            $aut = 0;
        }
        /**
         * -----------------------------------------------------------------------------------------------------
         */
        $this->telegramLogin($aut,$_REQUEST["user"],$_REQUEST["empresa"]);
        return($res);
    }

    public function logout(){
        $rec = array();
        $rec["lastLogout"] = date("Y-m-d H:i:s");
        $rec["session"] = "";
        $userU = User::find($_SESSION["userv"]["id"]);
        $userU->update($rec);
        $userU->save();

        $record = array();
        //$record["usuario"] = $_SESSION["userv"]["username"];
        $record["ip"] = Core::getIp();
        $record["Fecha"] = date('Y-m-d H:i:s');
        //$record["session"] = session_id();
        $record["web"] = $_SERVER['HTTP_REFERER'];
        $texto = "<b>[LOGOUT]</b>: \xE2\x9D\x8C Usuario: ".$_SESSION["userv"]["username"] ;
        Core::telegramSendmsgCore($texto,$record);

        if($_SESSION["exit"]){
            $salida = $_SESSION["exit"];
        }else{
            $salida = "/";
        }
        session_destroy();
        header("Location: ".$salida);

    }

    function telegramLogin($aut,$user,$empresa){
        $rec = array();
        //$rec["User"] = $user;
        $rec["Institution"] = $empresa;
        //$record["password"] = $pass;
        $rec["ip"] = Core::getIp();
        //$record["Date"] = date('Y-m-d H:i:s');
        $rec["Date"] = date('d/m/Y H:i:s');
        $rec["urlRef"] = $_SERVER['HTTP_REFERER'];
        $rec["urlHost"] = $_SERVER['HTTP_HOST'];

        if ($aut == 1){
            $texto = "<b>[login]</b>: [LOGIN] \xF0\x9F\x98\x83 User: ".$user ;
        }else{
            $texto = "<b>[login]</b>: [ERROR] \xF0\x9F\x98\xA1 User:".$user;
        }
        //$texto .= ", ".$string_log;
        Core::telegramSendmsgCore($texto,$rec);
    }

}
