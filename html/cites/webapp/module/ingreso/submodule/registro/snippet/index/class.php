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


    function item_update($rec,$que_form){
        global $smarty;
        $accion="new";
        $rec["usuario"]=strtolower(trim($rec["usuario"]));
        /**
         * Sacamos los datos del usuario para verificar si no existe.
         */
        $sql = "SELECT * FROM ".$this->tabla_core["usuario"]." AS u WHERE u.usuario ='".$rec["usuario"]."'";
        $it = $this->dbm->Execute($sql);
        $item = $it->fields;
        //print_struc($item);
        //exit;
        /**
         * Debugs
         */
        //$item["activo"]=0;
        //$rec["usuario"]="";
        /**
         * Fin debugs
         */

        if($item["itemId"]=="" || $item["activo"]==0){

            if($rec["usuario"]!=""){
                /**
                 * preprocesamos los datos
                 */
                $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion);

                /**
                 * Guardo los datos ya procesados
                 */
                if(isset($item["itemId"]) && $item["itemId"]!=""){
                    $accion="update";
                    $itemId = $item["itemId"];
                }else{
                    $itemId = "";
                }
                $where = "";
                $campo_id="itemId";
                $res = $this->item_update_sbm($itemId,$respuesta_procesa,$this->tabla_core["usuario"],$accion,$campo_id, $where);
                $res["accion"] = $accion;
                /**
                 * Para debugs
                 */
                $res["res"] = 1;
                /**
                 * Fin Debugs
                 */

                if($res["res"]==1){
                    /**
                     * Una vez registrado el usuario, cargamos los permisos para cites
                     */
                    /*
                    $rec0 = array();
                    $rec0["usuarioId"]=$res["id"];

                    $rec0["tipo"]=0;
                    $rec0["crear"]=1;
                    $rec0["editar"]=1;
                    $rec0["dateCreate"]= $rec0["dateUpdate"]=$respuesta_procesa["dateUpdate"];
                    $rec0["userCreate"]= $rec0["userUpdate"]=1;


                    $submodulos = "11,14,69,70,71,72,75,76,79,80,81,86,87,89,90,91";
                    $sm = explode(",",$submodulos);
                    foreach ($sm as $row){
                        $rec0["subModuloId"]=trim($row);
                        $this->dbm->AutoExecute($this->tabla_core["usuario_permisos"],$rec0);
                    }
                    */
                    /**
                     * Una vez registrado el usuario, lo relacionamos a una empresa
                     */
                    if($accion=="update"){
                        //$this->dbm->debug = true;
                        $sql = "SELECT * FROM ".$this->tabla["empresa"]." AS u WHERE u.usuario_id ='".$item["itemId"]."' limit 1";
                        $emp = $this->dbm->Execute($sql);
                        $empresa = $emp->fields;
                        $itemId = $empresa["itemId"];
                    }else{
                        $itemId = "";
                    }

                    $rec2 = array();
                    $rec2["tipo_id"] = $rec["tipo_id"];
                    $rec2["email"] = $rec["usuario"];
                    $rec2["pais_id"] = 26;
                    $rec2["estado_id"] = 1;
                    $rec2["dateUpdate"] = $rec2["dateCreate"] = $respuesta_procesa["dateUpdate"];
                    $rec2["userUpdate_nucleo"] = 1;
                    $rec2["usuario_id"] = $res["id"];

                    $campo_id="itemId";
                    $where = "";

                    //$this->dbm->debug =true;
                    $res2 = $this->item_update_sbm($itemId,$rec2,$this->tabla["empresa"],$accion,$campo_id, $where);

                    /**
                     * Enviamos a la vista las variables para crear el correo
                     */
                    $smarty->assign("verifica_codigo",$respuesta_procesa["verifica_codigo"]);
                    $smarty->assign("email_user", base64_encode(trim($respuesta_procesa["usuario"])));

                    $to["email"] = $respuesta_procesa["usuario"];
                    $to["name"] = $respuesta_procesa["usuario"];
                    $asunto = "[CITES Bolivia] - Verificación de correo electrónico";
                    $envio = $this->send_email_system($to,$asunto);
                    /*
                    if($envio["res"]==2){
                        $resp["resp"] = 2;
                        $resp["msg"] = $envio["msgdb"];
                    }else{
                        $resp["resp"] = 1;
                        $resp["msg"] = "Se ha enviado un correo electrónico para restablecer su contraseña";
                    }
                    */
                }
            }else{
                $res["res"] = 2;
                $res["msg"] = "El Usuario es invalido";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "El usuario ya se encuentra registrado y Activo";
        }
        return $res;
    }
    /**
     * Funcion que valida los campos a ser guardados
     **/
    function procesa_datos($que_form,$rec,$accion="new"){

        $dato_resultado = array();
        switch($que_form){
            case 'general':
                /**
                 * $rec = es el arreglo de datos que proviene del formulario, desde el frontend
                 * $$this->item_form = es el arreglo de configuraciòn de datos que se procesaran
                 * $accion = new, update
                 */

                $dato_resultado = $this->procesa_campos_sbm($rec,$this->campos[$que_form],$accion);
                /**
                 * Procesos Adicionales al momento de guardar los datos
                 */

                $codigo = $this->get_ramdom_string(40);
                $dato_resultado["verifica_codigo"]=$codigo;
                $dato_resultado["userUpdate"]=1;
                $dato_resultado["userCreate"]=1;
                $dato_resultado["tipoUsuario"]=2;
                $dato_resultado["activo"]=0;
                //$dato_resultado["activo"]=1;
                $dato_resultado["usuario"]=trim($dato_resultado["usuario"]);
                $dato_resultado["password"]=md5(trim($dato_resultado["password"]));

                break;
            case 'otros_formularios':
                break;
        }
        //print_struc($dato_resultado);
        return $dato_resultado;
    }



    public function restablece($user, $pass, $empresa, $nombre){

        global $db,$frontend,$smarty;
        /**
         * Sacamos los datos de la base de datos del usuario enviado
         */
        $sql = "INSERT INTO ".$this->tabla_core["usuario"]." (usuario, password, nombre, apellido) 
        VALUES ('".$user."','".$pass."','".$empresa."','".$nombre."')";


        $info = $db->Execute($sql);
        $item = $info->fields;

        /**
         * Realizamos los debidos controles
         */

        if($info){
            $resp["resp"] = 1;
            $resp["msg"] = "Se ha enviado un correo electrónico para la validación e ingreso al sistema";

        }else{
            $resp["resp"] = 2;
            $resp["msg"] = "El correo electrónico ya se encuentra registrado";
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


    public function verifica($c,$e){
        if(trim($c)!=""){
            $e = base64_decode($e);
            $sql = "SELECT * FROM ".$this->tabla_core["usuario"]." AS u WHERE u.usuario = '".$e."' AND u.verifica_codigo='".$c."'";
            $info = $this->dbm->Execute($sql);
            $item = $info->fields;
        }
        return $item;
    }

    public function valida_email($c,$e){
        global $db,$frontend,$smarty;

        /**
         * Verificamos si existe el usuario
         */
        $item = $this->verifica($c,$e);
        if($item["itemId"]!=""){
            $e = base64_decode($e);

            $rec = array();
            $rec["verifica_fecha"] = date("Y-m-d H:i:s");
            $rec["verifica_email"] = 1;
            $rec["verifica_codigo"] = null;
            $rec["activo"] = 1;


            //$db->debug = true;
            $db->AutoExecute($this->tabla_core["usuario"],$rec,"UPDATE","itemId='".$item["itemId"]."'");
            //exit;
            /**
             * Enviamos a la vista las variables para crear el correo
             */

            $smarty->assign("email_user", trim($e));

            $to["email"] = $item["usuario"];
            $to["name"] = $item["usuario"];

            $asunto = "[CITES Bolivia] Su cuenta fue activada";
            $envio = $this->send_email_system($to,$asunto);

            $resp["resp"] = 1;
            $resp["msg"] = "Se cambio con exito la contraseña";
        }else{
            $resp["resp"] = 2;
            $resp["msg"] = "Los datos de verificación de correo electrónico son incorrectos";
        }

        return $resp;
    }

}