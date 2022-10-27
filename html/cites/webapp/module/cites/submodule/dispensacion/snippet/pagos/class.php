<?php
class Snippet extends Table
{
    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }
    /**
     * Implementación desde aca
     */

    public function get_item_datatable_Rows($item_id){
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */

        $table = $this->tabla["empresa_pago"];
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = 'itemId';
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "archivo";
        /**
         * la configuración de base de datos que utilizaremos
         * que se la realiza en inc/db.php
         */
        $db=$db_conf_datatable["principal"];
        /**
         * Configuraciones adicionales
         */
        $extraWhere = " i.empresa_id = ".$this->empresa_id." and i.categoria_id = 3 and i.dispensacion_id='".$item_id."' ";
        $groupBy = "";
        $having = "";

        /**
         * Resultado de la consulta enviada
         */
        $resultado = $this->get_grilla_datatable_simple($db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having, "right");
        $resultado["recordsTotal"]=$resultado["recordsFiltered"];

        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */
        return $resultado;

    }

    /**
     * Function que actualiza la informacion de datos de un registro
     * $respuesta = $subObjItem->item_update($item,$itemId,0);
     * $rec = arreglo de datos que llega del formulario
     * $itemId= el id del reguistro que quiero actualizar
     * $que_form = El formulario dentro que quiero actualizar, "Es el mismo nombre del grupo de campos que quiero validar"
     * $accion = new, update ,  solo existen 2 acciones
     *
     **/
    function item_update($rec,$itemId,$que_form,$accion,$item_id,$input_archivo){
        global $objItem;
        /**
         * Verificamos primero el estado de a dispensación antes de guardar todos los datos
         * el estado del padre es el que manda al momento de guardar los datos
         */
        $item = $objItem->get_item($item_id);
        $bandera = 0;
        if($item["estado_id"]==4){
            $res["res"] = 2;
            $res["msg"] = "Esta solicitud ya se encuentra Validado";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==2){
            $res["res"] = 2;
            $res["msg"] = "Esta solicitud esta en proceso de validación";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==5 or $item["estado_id"]==6 ){
            $res["res"] = 2;
            $res["msg"] = "Esta solicitud fue rechazada o cancelada";
            $res['accion'] = $accion;
        }else if($item["itemId"]!=""){
            $bandera = 1;
        }else{
            $res["res"] = 2;
            $res["msg"] = "No existe los datos que quiere modificar";
            $res['accion'] = $accion;
        }

        if($bandera==1){
            /**
             * preprocesamos los datos
             */
        if(isset($rec["empresa_id"])) unset($rec["empresa_id"]);
        if(isset($rec["dispensacion_id"])) unset($rec["dispensacion_id"]);
        $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion,$item_id);
        /**
         * Guardo los datos ya procesados
         */
        if($accion == 'update') $item = $this->get_item($itemId, $item_id);

        if(($item["itemId"]!="" and $item["modifica"]==1)  or $accion=="new"){

            $tabla = $this->tabla["empresa_pago"];
            $campo_id="itemId";
            $where = " empresa_id = '".$this->empresa_id."' and dispensacion_id= '".$item_id."' and categoria_id=3  " ;
            $res = $this->item_update_sbm($itemId,$respuesta_procesa,$tabla,$accion,$campo_id,$where);
            $res["accion"] = $accion;
            /**
             * Procesamos el archivo
             */
            if( $res["res"]==1){
                $item = $this->get_item($res["id"],$item_id);
                $carpeta = "pagos";
                $adjunto = $this->item_adjunto_sbm($input_archivo,$this->empresa_id,$res["id"],$item,$tabla,$accion,"empresa_id",$carpeta);
            }

        }else if(isset($item['categoria_id']) and $item['categoria_id']!=3){
            $res['res'] = 2;
            $res['msg'] = "El tipo de pago no se puede editar.";
            $res['accion'] = $accion;
        }else if(isset($item['verificado']) and $item['verificado']==1){
            $res['res'] = 2;
            $res['msg'] = "El pago ya fue verificado y no puede ser modificado";
            $res['accion'] = $accion;
        }else if( isset($item["itemId"]) ){
            $res['res'] = 2;
            $res['msg'] = "No se puede modificar este registro";
            $res['accion'] = $accion;
        }else{
            $res['res'] = 2;
            $res['msg'] = "El registro que quiere editar no existe.";
            $res['accion'] = $accion;
        }
    }
        return $res;
    }

    /**
     * Funcion que valida los campos a ser guardados
     **/
    function procesa_datos($que_form,$rec,$accion="new",$item_id){
        $dato_resultado = array();
        switch($que_form){
            case 'archivo':
                /**
                 * $rec = es el arreglo de datos que proviene del formulario, desde el frontend
                 * $$this->item_form = es el arreglo de configuraciòn de datos que se procesaran
                 * $accion = new, update
                 */
                $dato_resultado = $this->procesa_campos_sbm($rec,$this->campos[$que_form],$accion);
                /**
                 * Procesos Adicionales al momento de guardar los datos
                 */

                if ($accion=="new"){
                    $dato_resultado["empresa_id"] = $this->empresa_id;
                    $dato_resultado["dispensacion_id"] = $item_id;
                    $dato_resultado["categoria_id"] = 3; //Empresa
                    $dato_resultado["estado_id"] = 1; //Registrado
                }
                break;
            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }

    function get_item($id,$item_id, $all=0){
        if($all == 0){
            $sql = "select * from ".$this->tabla["empresa_pago"]." as p where p.itemId = '".$id."' 
        and empresa_id = '" . $this->empresa_id. "' and categoria_id= '3' and dispensacion_id='".$item_id."'";
        }else{
            $sql = "select * from ".$this->tabla["empresa_pago"]." as p where p.itemId = '".$id."' 
        and empresa_id = '" . $this->empresa_id. "' and dispensacion_id='".$item_id."'";
        }

        $item = $this->dbm->Execute($sql);
        $item = $item->fields;

        /**
         * si se puede modificar el registro o no
         */
        if( ($item['itemId'] != "" and  $item['categoria_id']==3)
            and ( $item['estado_id'] == 1 or  $item['estado_id'] == 3)
        ){
            $item["modifica"]=1;
        }else{
            $item["modifica"]=0;
        }
        return $item;
    }

    function get_file($id,$item_id){
        $msg_erro = "<div style='text-align: center;  background-color: #fee7dc;vertical-align: center; padding-top: 50px;padding-bottom: 50px;'><span style='color:red; font-family: Arial;font-size:26px;'>El Archivo No existe</span></div>";
        $item = $this->get_item($id,$item_id);
        if($item["itemId"]!=""){
            $carpeta = "pagos";
            $dir  = $this->get_dir_item_archivo_sbm($this->empresa_id,0,$carpeta);
            $archivo = $dir.$id.".".$item["adjunto_extension"];
            if(file_exists($archivo)){
                header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
                header ("Cache-Control: no-cache, must-revalidate");
                header ("Pragma: no-cache");
                header ("Content-Type:".$item["adjunto_tipo"]);
                header ('Content-Disposition: attachment; filename="'.$item["adjunto_nombre"].'"');
                header ("Content-Length: " . $item["adjunto_tamano"]);
                readfile($archivo);
                exit;
            }else{
                echo $msg_erro;
            }
        }else{
            echo $msg_erro;
        }
        exit;
    }
    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id,$item_id){
        global $objItem;
        $item = $objItem->get_item($item_id);
        $bandera = 0;

        if($item["estado_id"]==4){
            $res["res"] = 2;
            $res["msg"] = "Esta dispensación ya se encuentra Validado";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==2){
            $res["res"] = 2;
            $res["msg"] = "Esta dispensación esta en proceso de validación";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==5 or $item["estado_id"]==6 ){
            $res["res"] = 2;
            $res["msg"] = "Esta dispensación fue rechazado o cancelado";
            $res['accion'] = $accion;
        }else if($item["itemId"]!=""){
            $bandera = 1;
        }else{
            $res["res"] = 2;
            $res["msg"] = "No existe los datos que quiere modificar";
            $res['accion'] = $accion;
        }
        /**
         * Iniciamos el proceso de guardado de datos de los pagos
         */
        if($bandera==1){
        $item = $this->get_item($id,$item_id);
        if($item["itemId"]!="" and $item["modifica"]==1){
            /**
             * borramos el archivo primero
             */
            $carpeta = "pagos";
            $this->item_delete_archivo_item_sbm($id,$this->empresa_id,$item,$carpeta);

            /**
             * Luego borrarmos el registro de la base de datos
             */
            $campo_id="itemId";
            $where = "empresa_id = '".$this->empresa_id."' and dispensacion_id='".$item_id."' and categoria_id=3 ";
            $res = $this->item_delete_sbm($id,$campo_id,$this->tabla["empresa_pago"],$where);
        }else{
            $res['res'] = 2;
            $res['msg'] = "No es posible borrar el archivo";
        }
    }
        return $res;
    }
}