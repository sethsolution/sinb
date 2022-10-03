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

    function obtenerUsuario(){

        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);
                $sql="SELECT  t1.tco_itemId, ur2.rol_itemId
                FROM  vrhr_snir.core_usuario u2
                LEFT JOIN usuario_rol ur2 on ur2.usuario_itemId=u2.itemId
                ,representante_legal t1
                LEFT JOIN usuario_rol ur on ur.itemId=t1.usuario_itemId
                LEFT JOIN vrhr_snir.core_usuario u on u.itemId=ur.usuario_itemId
                WHERE u2.itemId= ".$_SESSION["memberId"]." and (u.itemId=".$_SESSION["memberId"]." or ur2.rol_itemId=1 or ur2.rol_itemId=6)
                group by ur2.rol_itemId"
                ;

            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
            return $info;
        }
    function item_update($rec,$itemId,$que_form,$accion){
        /**
         * preprocesamos los datos
         */
        $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion);
        /**
         * Guardo los datos ya procesados
         */
        $campo_id="itemId";
        $res = $this->item_update_sbm($itemId,$respuesta_procesa,$this->tabla["c_indice"],$accion,$campo_id);
        $res["accion"] = $accion;

        return $res;
    }
    /**
     * Funcion que valida los campos a ser guardados
     **/
    function procesa_datos($que_form,$rec,$accion="new"){
        $dato_resultado = array();
        switch($que_form){
            case 'c_indice':
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
}