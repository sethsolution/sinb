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
    function item_update($rec,$itemId,$que_form,$accion){
        //$this->dbm->debug=true;
        /**
         * preprocesamos los datos
         */
        $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion,"");
        /**
         * Guardo los datos ya procesados
         */
        $campo_id="itemId";
        $res = $this->item_update_sbm($itemId,$respuesta_procesa,$this->tabla["lugar"],$accion,$campo_id);
        $res["accion"] = $accion;

        return $res;
    }
    /**
     * Funcion que valida los campos a ser guardados
     **/
    function procesa_datos($que_form,$rec,$accion="new",$item_id){
        $dato_resultado = array();
        switch($que_form){
            case 'lugar':
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
                    $dato_resultado["activo"] = 1;
                    $dato_resultado["parent"] = $item_id;
                }

                break;
            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }
}