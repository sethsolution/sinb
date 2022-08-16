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

        $table = $this->tabla["especie"];
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
        $extraWhere = " i.empresa_id = ".$this->empresa_id." and i.cites_id='".$item_id."' ";

        $groupBy = "";
        $having = "";

        /**
         * Resultado de la consulta enviada
         */
        $resultado = $this->get_grilla_datatable_simple($db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having);
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
    function item_update($rec,$itemId,$que_form,$accion,$item_id){
        global $objItem;
        /**
         * Verificamos primero el estado de la cite antes de guardar todos los datos
         * el estado del padre es el que manda al momento de guardar los datos
         */
        $item = $objItem->get_item($item_id);
        $bandera = 0;
        if($item["estado_id"]==4){
            $res["res"] = 2;
            $res["msg"] = "Este cite ya se encuentra Validado";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==2){
            $res["res"] = 2;
            $res["msg"] = "Este cite esta en proceso de validación";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==5 or $item["estado_id"]==6 ){
            $res["res"] = 2;
            $res["msg"] = "Este cite fue rechazado o cancelado";
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
            /**
             * preprocesamos los datos
             */
            if(isset($rec["empresa_id"])) unset($rec["empresa_id"]);
            if(isset($rec["cites_id"])) unset($rec["cites_id"]);
            $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion,$item_id);
            /**
             * Guardo los datos ya procesados
             */
            if($accion == 'update') $item = $this->get_item($itemId, $item_id);

            if(($item["itemId"]!="")  or $accion=="new"){
                $tabla = $this->tabla["especie"];
                $campo_id="itemId";
                $where = " empresa_id = '".$this->empresa_id."' and cites_id= '".$item_id."' " ;
                $res = $this->item_update_sbm($itemId,$respuesta_procesa,$tabla,$accion,$campo_id,$where);
                $res["accion"] = $accion;

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
        //print_struc($rec);exit();
        $dato_resultado = array();
        switch($que_form){
            case 'especie':
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
                    $dato_resultado["cites_id"] = $item_id;
                }
                break;
            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }

    function get_item($id,$item_id){
        $sql = "select * from ".$this->tabla["especie"]." as p where p.itemId = '".$id."' 
        and empresa_id = '" . $this->empresa_id. "' and cites_id='".$item_id."'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id,$item_id){
        global $objItem;
        /**
         * Verificamos primero el estado de la cite antes de guardar todos los datos
         * el estado del padre es el que manda al momento de guardar los datos
         */
        $item = $objItem->get_item($item_id);
        $bandera = 0;
        if($item["estado_id"]==4){
            $res["res"] = 2;
            $res["msg"] = "Este cite ya se encuentra Validado";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==2){
            $res["res"] = 2;
            $res["msg"] = "Este cite esta en proceso de validación";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==5 or $item["estado_id"]==6 ){
            $res["res"] = 2;
            $res["msg"] = "Este cite fue rechazado o cancelado";
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
            if($item["itemId"]!=""){
                /**
                 * borrarmos el registro de la base de datos
                 */
                $campo_id="itemId";
                $where = "empresa_id = '".$this->empresa_id."' and cites_id='".$item_id."' ";
                $res = $this->item_delete_sbm($id,$campo_id,$this->tabla["especie"],$where);
            }else{
                $res['res'] = 2;
                $res['msg'] = "No es posible borrar el archivo";
            }
        }

        return $res;
    }


}