<?
class Login{
    var $auth;
    function __construct(){
        
    }
    
    /**
     * Login::closeSession()
     * 
     * Cierra la sesion, el parametro que se enviea
     * 1: cierre por usuario
     * 2: cierre por tiempo limite
     * 
     * @param int $type
     * @return void
     */
    function closeSession($type){
        global $sysLog,$db,$core;
        global $_SESSION;
        $record = array();
        $record["lastLogout"] = date("Y-m-d H:i:s");
        $record["session"] ="";
        switch($type){
            case 1:
                $sysLog->writeLog("login","close","ok",$record,"","usuario",$_SESSION["userv"]["itemId"],$_SESSION["userv"]["itemId"]);
            break;
            case 2:
                $sysLog->writeLog("login","close","timeout",$record,"","usuario",$_SESSION["userv"]["itemId"]);
            break;
        }




        $db->AutoExecute("usuario", $record, "UPDATE", " itemId='" . $_SESSION["userv"]["itemId"]."'");
        /**
         * para enviar por telegram
         */
        $record = array();
        $record["usuario"] = $_SESSION["userv"]["usuario"];
        $record["ip"] = $core->getIp();
        $record["Fecha"] = date('Y-m-d H:i:s');
        //$record["session"] = session_id();
        $record["web"] = $_SERVER['HTTP_REFERER'];
        $texto = "<b>[login]</b>: [SALIO] \xE2\x9D\x8C Usuario: ".$_SESSION["userv"]["usuario"] ;
        //$core->telegram_sendmsg_core($texto,$record);
        $core->telegram_sendmsg_core($texto,"");
        session_destroy();
    }  
    /**
     * Login::userAuthenticate()
     * Nos permite autentificar a un usuario,
     * se manda los parametros de usuario y contrase�a,
     * nos devolvera los 0,1
     * 
     * @param string $user
     * @param string $pass
     * @return int
     */
    function userAuthenticate($user,$pass){
        global $db,$_SESSION,$sysLog,$core,$smarty,$CFG;
        $user = utf8_decode($user);
        $passMd5 = $pass;
        $sql = "select u.* from usuario as u
                where u.usuario='".$user."' 
                and u.password='" . $passMd5 . "'
                and u.activo = 1 limit 1";

        $info = $db->Execute($sql);
        $item = $info->fields;


        $res = array();
        if ($item["usuario"] == ""){
            $res["res"] = 2;
            $res["msg"] = "Los datos de acceso del usuario son incorrectos";
        }else{
            /**
             * Verificamos si se encuentra registrado la empresa
             */

            $sql = "SELECT * FROM ".$CFG->tabla["cites_empresa"]." AS i WHERE i.usuario_id = '".$item["itemId"]."' ";
            $info = $db->execute($sql);
            $empresa = $info->fields;

            if($empresa["itemId"]==""){
                $res["res"] = 3;
                $res["msg"] = "No se encontro la empresa";
            }else{
                $res["res"] = 1;
                $res["msg"] = "Exito!!!";
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
            $record = array();
            $record["lastLogin"] = date('Y-m-d H:i:s');
            $record["ip"] = $core->getIp();
            $record["session"] = session_id();
            $db->AutoExecute($CFG->tabla["usuario"], $record, "UPDATE", " itemId='".$item["itemId"]."'");
            $_SESSION["userv"] = $item;
            $_SESSION["empresa"] = $empresa;
            $_SESSION["auth"] = true;

            $sysLog->writeLog("login","enter","ok",$record,"","usuario",$item["itemId"]);
        }else{
            $aut = 0;
            /***
             * Guardamos en la sessión el error, ademas de generar logs
             */
            $_SESSION["error"] = 1;
            $resLog = array();
            $resLog["usuario"] = $user;
            $resLog["password"] = $pass;
            $resLog["empresa"] = $empresa;
            $sysLog->writeLog("login","enter","error",$resLog,"","usuario");
        }
        $this->telegram_login($aut,$user,$pass,$empresa_alias);
        $smarty->assign("sess",$_SESSION);

        return($res);
    }

    function telegram_login($aut,$user,$pass){
        global $core;

        $record = array();
        $record["usuario"] = $user;
        //$record["password"] = $pass;
        $record["ip"] = $core->getIp();
        $record["Fecha"] = date('Y-m-d H:i:s');
        //$record["session"] = session_id();
        $record["web"] = $_SERVER['HTTP_REFERER'];

        if ($aut == 1){
            $texto = "<b>[login]</b>: [ENTRO] \xF0\x9F\x98\x83 Usuario: ".$user ;
        }else{
            $texto = "<b>[login]</b>: [ERROR] \xF0\x9F\x98\xA1 Usuario:".$user;
        }
        //$texto .= ", ".$string_log;
        //$core->telegram_sendmsg_core($texto,$record);
        $core->telegram_sendmsg_core($texto,$record );

    }
}
