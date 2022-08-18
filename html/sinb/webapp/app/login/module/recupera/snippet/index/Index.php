<?PHP
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 17/06/2020
 * Time: 19:14
 */

class Index extends CoreResources {

    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }

    public function restablece($user){
        global $db,$frontend,$smarty;
        /**
         * Sacamos los datos de la base de datos del usuario enviado
         */
        $sql = "SELECT * FROM ".$this->table_core["usuario"]." AS i WHERE i.usuario = '".$user."'";
        $info = $db->Execute($sql);
        $item = $info->fields;

        /**
         * Realizamos los debidos controles
         */

        if(trim($item["usuario"])!=""){

            /**
             * Genera código de recuperación y guarda en la base de datos
             */
            $rec = array();
            $rec["recupera_fecha"] = date("Y-m-d H:i:s");
            $rec["recupera_codigo"] = $this->generateRandomString(40);
            $db->AutoExecute($this->table_core["usuario"],$rec,"UPDATE","itemId='".$item["itemId"]."'");
            /**
             * Envio de correo electrónico
             */
            /**
             * Enviamos a la vista las variables para crear el correo
             */

            $smarty->assign("recupera_codigo",$rec["recupera_codigo"]);
            $smarty->assign("email_user", base64_encode(trim($user)));

            $to["email"] = $item["usuario"];
            $to["name"] = $item["nombre"]." ".$item["apellido"];

            $asunto = "Restablecer Contraseña de acceso a CITES Bolivia";
            $envio = $this->send_email_system($to,$asunto);

            if($envio["res"]==2){
                $resp["resp"] = 2;
                $resp["msg"] = $envio["msgdb"];
            }else{
                $resp["resp"] = 1;
                $resp["msg"] = "Se ha enviado un correo electrónico para restablecer su contraseña";
            }

        }else{
            $resp["resp"] = 2;
            $resp["msg"] = "El correo electrónico no se encuentra registrado";
        }

        return $resp;
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}