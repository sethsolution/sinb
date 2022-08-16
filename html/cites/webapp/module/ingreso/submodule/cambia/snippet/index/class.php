<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 17/06/2020
 * Time: 19:14
 */

class Index extends Table {

    function __construct()
    {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    public function verifica($c,$e){
        global $db;

        if(trim($c)!=""){
            $e = base64_decode($e);
            $sql = "SELECT * FROM usuario AS u WHERE u.usuario = '".$e."' AND u.recupera_codigo='".$c."'";
            $info = $db->Execute($sql);
            $item = $info->fields;
        }

        return $item;
    }

    public function cambia_password($c,$e,$password){
        global $db,$frontend,$smarty;
        /**
         * Verificamos si existe el usuario
         */
        $item = $this->verifica($c,$e);


        if($item["itemId"]!=""){
            $e = base64_decode($e);

            $rec = array();
            $rec["recupera_fecha_cambio"] = date("Y-m-d H:i:s");
            $rec["recupera_codigo"] = null;
            $rec["password"] = $password;
            //print_struc($rec);
            //$db->debug = true;
            $db->AutoExecute($this->tabla_core["usuario"],$rec,"UPDATE","itemId='".$item["itemId"]."'");
            /**
             * Enviamos a la vista las variables para crear el correo
             */

            $smarty->assign("email_user", trim($e));

            $to["email"] = $item["usuario"];
            $to["name"] = $item["nombre"]." ".$item["apellido"];

            $asunto = "[CITES] Se cambio tu contraseña de acceso a CITES Bolivia";
            $envio = $this->send_email_system($to,$asunto);

            $resp["resp"] = 1;
            $resp["msg"] = "Se cambio con exito la contraseña";
        }else{
            $resp["resp"] = 2;
            $resp["msg"] = "Los datos de verificación de cambio de contraseña son incorrectos";
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