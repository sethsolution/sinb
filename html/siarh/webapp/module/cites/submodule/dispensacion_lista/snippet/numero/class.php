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

        $table = $this->tabla["numero"];
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
        $extraWhere = " i.dispensacion_id='".$item_id."' ";

        $groupBy = "";
        $having = "";

        /**
         * Resultado de la consulta enviada
         */
        $resultado = $this->get_grilla_datatable_simple($db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having);
        $resultado["recordsTotal"]=$resultado["recordsFiltered"];

        /*
        foreach ($resultado['data'] as $itemId => $valor) {
            //$resultado['data'][$itemId]['fecha_pago'] = date_format(date_create($valor['fecha_pago']),"d/m/Y");
            if($valor['observacion_fecha'] !="") $resultado['data'][$itemId]['observacion_fecha'] = date_format(date_create($valor['observacion_fecha']),"d/m/Y H:i:s");
            if($valor['aprobado_fecha'] !="") $resultado['data'][$itemId]['aprobado_fecha'] = date_format(date_create($valor['aprobado_fecha']),"d/m/Y H:i:s");
        }
        */
        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */
        return $resultado;

    }

    function item_update_detalle($rec,$itemId,$que_form,$accion,$item_id){

        /**
         * Sacamos los datos del item para su verificación
         */
        $item = $this->get_item($itemId, $item_id);
        
        if($item["estado_id"]==4) {
            $res["res"] = 2;
            $res["msg"] = "Este cite ya se encuentra Validado";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==5 or $item["estado_id"]==6 ){
            $res["res"] = 2;
            $res["msg"] = "Este cite fue rechazado o cancelado";
            $res['accion'] = $accion;
        }else if($item["itemId"]!="" and  $item["estado_id"]==2){
            /**
             * preprocesamos los datos
             */
            if (isset($rec["itemId"])) unset($rec["itemId"]);
            $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion,$item_id, $item);

            /**
             * Guardo los datos ya procesados
             */
            $campo_id="itemId";
            $where = "";
            $res = $this->item_update_sbm($itemId,$respuesta_procesa,$this->tabla["dispensacion"],$accion,$campo_id, $where);
            $res["accion"] = $accion;

            if($res["res"]){}
        }else{
            $res["res"] = 2;
            $res["msg"] = "No existe los datos que quiere modificar";
            $res['accion'] = $accion;
        }

        return $res;
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
    function item_update($rec,$itemId,$que_form,$accion,$item_id){

        global $objItem;

        /**
         * preprocesamos los datos
         */
        if(isset($rec["dispensacion_id"])) unset($rec["dispensacion_id"]);
        $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion,$item_id,$rec);
        /**
         * Guardo los datos ya procesados
         */
        if($accion == 'update') $item = $this->get_item($itemId, $item_id);

        if(($item["itemId"]!="")  or $accion=="new"){

            $tabla = $this->tabla["numero"];
            $campo_id="itemId";
            $where = " dispensacion_id= '".$item_id."' " ;
            $res = $this->item_update_sbm($itemId,$respuesta_procesa,$tabla,$accion,$campo_id,$where);
            $res["accion"] = $accion;

        }else{
            $res['res'] = 2;
            $res['msg'] = "El registro que quiere editar no existe.";
            $res['accion'] = $accion;
        }

        return $res;
    }



    /**
     * Funcion que valida los campos a ser guardados
     **/
    function procesa_datos($que_form,$rec,$accion="new",$item_id, $item){
        //print_struc($rec);exit();
        $dato_resultado = array();
        switch($que_form){
            case 'numero':
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
                    $dato_resultado["dispensacion_id"] = $item_id;
                    $dato_resultado["estado_numero_id"] =1;
                }
                break;

            case 'general':
                /**
                 * $rec = es el arreglo de datos que proviene del formulario, desde el frontend
                 * $$this->item_form = es el arreglo de configuraciòn de datos que se procesaran
                 * $accion = new, update
                 */
                $dato_resultado = $this->procesa_campos_sbm($rec,$this->campos[$que_form],$accion);

                /**
                 * Procesos Adicionales al momento de guardar los datos
                 * se calculan la fecha de expiracion, el admisnitrador podra editar
                 */
                $date = $dato_resultado["emitido_fecha"];
                if($item['tipo_documento_id'] == 1  or $item["tipo_documento_id"] == 2){
                    $date_expiracion = strtotime('+180 day', strtotime($date));
                    $dato_resultado["fecha_expiracion"] = date('Y-m-d', $date_expiracion);
                }
                if($item['tipo_documento_id'] == 3){
                    $date_expiracion = strtotime('+365 day', strtotime($date));
                    $dato_resultado["fecha_expiracion"] = date('Y-m-d', $date_expiracion);
                }
                $dato_resultado["info_final"] = 1;
                if ($accion=="new"){
                }
                break;
            case 'otros_formularios':
                break;

        }
        return $dato_resultado;
    }

    function get_item($id,$item_id){
        if($item_id != ''){
            $sql = "select * from ".$this->tabla["numero"]." as p where p.itemId = '".$id."' 
            and dispensacion_id='".$item_id."'";
            $item = $this->dbm->Execute($sql);
            $item = $item->fields;
            return $item;
        }else{
            $info = '';
            if($id!=''){
                $sql = "SELECT
                    i.*
                    FROM ".$this->tabla["dispensacion"]." AS i
                    WHERE i.itemId =  '".$id."' ";
                $info = $this->dbm->Execute($sql);
                $info = $info->fields;
            }
            return $info;
        }
    }


    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id,$item_id){

        $item = $this->get_item($id,$item_id);
        if($item["itemId"]!=""){
            /**
             * borrarmos el registro de la base de datos
             */
            $campo_id="itemId";
            $where = "dispensacion_id='".$item_id."' ";
            $res = $this->item_delete_sbm($id,$campo_id,$this->tabla["numero"],$where);
        }else{
            $res['res'] = 2;
            $res['msg'] = "No es posible borrar el archivo";
        }


        return $res;
    }

}