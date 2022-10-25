<?
class Login
{
    var $auth;

    function __construct()
    {

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
    function closeSession($type)
    {
        global $sysLog, $db;
        global $_SESSION;
        $record = array();
        $record["lastLogout"] = date("Y-m-d H:i:s");
        $record["session"] = "";
        switch ($type) {
            case 1:
                $sysLog->writeLog("login", "close", "ok", $record, "", "core_usuario", $_SESSION["userv"]["itemId"], $_SESSION["userv"]["itemId"]);
                break;
            case 2:
                $sysLog->writeLog("login", "close", "timeout", $record, "", "core_usuario", $_SESSION["userv"]["itemId"]);
                break;
        }
        $db->AutoExecute("core_usuario", $record, "UPDATE", " itemId='" . $_SESSION["userv"]["itemId"] . "'");

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
    function userAuthenticate($user, $pass)
    {
        global $db, $_SESSION, $sysLog, $core, $smarty;
        $user = utf8_decode($user);
        //$passMd5 = md5($pass);
        $passMd5 = $pass;
        /*
        $sql = "    select u.*, GROUP_CONCAT(ui.institucionId) as instituciones from core_usuario as u
                left join core_usuario_institucion ui on ui.usuarioId=u.itemId and ui.activo=1
                where u.usuario='" . $user . "' 
                and u.password='" . $passMd5 . "'
                and u.activo = 1";
        */
        $bindVars = array($user,$passMd5);
        $sql = "select u.* from core_usuario as u
                where u.usuario=? 
                and u.password=?
                and u.activo = 1";
        /*
        $sql = "select u.* from core_usuario as u
                where u.usuario='".$user."' 
                and u.password='" . $passMd5 . "'
                and u.activo = 1";
        */
        //echo $sql;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = $db->Execute($sql,$bindVars);
        if ($info->fields["usuario"] == "") {
            $aut = 0;
        } else {
            $item = $info->GetRows();
            $item = $item[0];
            $item["memberId"] = $item["itemId"];
            $aut = 1;
        }
        /**
         * Si los datos de acceso son correcto,
         * se realizar las siguientes acciones:
         * - Guarda log de ingreso en base de datos
         * - Guarda un log en archivo.
         */
        if ($aut == 1) {
            $_SESSION["error"] = 0;
            $record = array();
            $record["lastLogin"] = date('Y-m-d H:i:s');
            $record["ip"] = $core->getIp();
            $record["session"] = session_id();
            $db->AutoExecute("core_usuario", $record, "UPDATE", " itemId='" . $item["itemId"] . "'");
            $_SESSION["userv"] = $item;
            $_SESSION["auth"] = true;
            $_SESSION["memberId"] = $item["itemId"];
            $sysLog->writeLog("login", "enter", "ok", $record, "", "core_usuario", $item["itemId"]);
        } else {
            /* Si ha encontrado un error lo bota del sistema */
            $_SESSION["error"] = 1;
            $resLog = array();
            $resLog["usuario"] = $user;
            $resLog["password"] = $pass;
            $sysLog->writeLog("login", "enter", "error", $resLog, "", "core_usuario");
        }


        $this->telegram_login($aut, $user, $pass);

        $smarty->assign("sess", $_SESSION);
        return ($aut);
    }

    function telegram_login($aut, $user, $pass)
    {
        global $core,$CFG;

        if ($CFG->telegram["log_login"]){
            $record = array();
            $record["usuario"] = $user;
            //$record["password"] = $pass;
            $record["ip"] = $core->getIp();
            $record["Fecha"] = date('Y-m-d H:i:s');
            //$record["session"] = session_id();
            /*
            if($_SERVER['HTTP_REFERER']){
                $record["web"] = $_SERVER['HTTP_REFERER'];
                $record["web"] = str_replace("http://","",$record["web"]);
                $record["web"] = str_replace("https://","",$record["web"]);
            }
            */
            if ($aut == 1) {
                $texto = "\xE2\x9C\x85 <b>[login]</b> Ingreso al sistema ";
            } else {
                $texto = "\xE2\x9D\x8C <b>[login]</b> Ocurrio un error";
            }
            //$string_log = json_encode($record);
            //$texto .= ", ".$string_log;

            $core->telegram_sendmsg_core($texto, $record);
        }

    }
}