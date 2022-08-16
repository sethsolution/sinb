<?php
class Snippet extends Table
{
    var $item_form;
    function __construct()
    {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();

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
    function item_update($rec,$que_form,$accion){
        $item = $this->get_item($itemId);
        if($item["estado_id"]==4){
            $res["res"] = 2;
            $res["msg"] = "Esta empresa ya se encuentra Validado";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==2){
            $res["res"] = 2;
            $res["msg"] = "Esta empresa esta en proceso de validación";
            $res['accion'] = $accion;
        }else if($item["itemId"]!=""){
            /**
             * ItemId será el mismo is del usuario
             */
            $itemId= $this->empresa_id;
            $accion=="update";

            $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion);
            /**
             * Guardo los datos ya procesados
             */
            $campo_id="itemId";
            $res = $this->item_update_sbm($itemId,$respuesta_procesa,$this->tabla["empresa"],$accion,$campo_id);
            $res["accion"] = $accion;

            if($res["res"]){
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "No existe los datos que quiere modificar";
            $res['accion'] = $accion;
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
                break;
            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }

    function get_item(){
        $sql = " select * from ".$this->tabla["empresa"]." where itemId= '".$this->empresa_id."' ";
        $info = $this->dbm->Execute($sql);
        $info = $info->fields;
        return $info;
    }
}