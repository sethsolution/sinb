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

        $table = $this->tabla["mensaje"];
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = 'itemId';
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "mensaje";
        /**
         * la configuración de base de datos que utilizaremos
         * que se la realiza en inc/db.php
         */
        $db=$db_conf_datatable["principal"];
        /**
         * Configuraciones adicionales
         */
        $extraWhere = "dispensacion_id='".$item_id."' and i.empresa_id = ".$this->empresa_id;
;
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
        $tabla = $this->tabla["mensaje"];
        /**
         * preprocesamos los datos
         */
        if (isset($rec["empresa_id"])) unset($rec["empresa_id"]);
        $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion,$item_id);
        /**
         * Guardo los datos ya procesados
         */
        if($accion == 'update') $item = $this->get_item($itemId, $item_id);
        if($item['itemId'] != "" or $accion=="new"){
            $campo_id="itemId";
        $where =  "dispensacion_id='" . $item_id . "' and i.empresa_id = " . $this->empresa_id;
            $res = $this->item_update_sbm($itemId,$respuesta_procesa,$tabla,$accion,$campo_id,$where);
        $res["accion"] = $accion;
        }else{
            $res['res'] = 2;
            $res['msg'] = "El registro que quiere editar no existe.";
            $res['accion'] = $accion;
        }

        /**
         * Procesamos el archivo
         */
        if( $res["res"]==1){
        }
        return $res;
    }

    /**
     * Funcion que valida los campos a ser guardados
     **/
    function procesa_datos($que_form,$rec,$accion="new",$item_id){
        $dato_resultado = array();
        switch($que_form){
            case 'index':
                /**
                 * $rec = es el arreglo de datos que proviene del formulario, desde el frontend
                 * $$this->item_form = es el arreglo de configuraciòn de datos que se procesaran
                 * $accion = new, update
                 */
                $dato_resultado = $this->procesa_campos_sbm($rec,$this->campos[$que_form],$accion);
                /**
                 * Procesos Adicionales al momento de guardar los datos
                 */
                $dato_resultado["dispensacion_id"] = $item_id;
                if ($accion == "new") {
                    $dato_resultado["empresa_id"] = $this->empresa_id;
                }
                break;
            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }

    function get_item($id,$item_id){
        $sql = "select * from ".$this->tabla["mensaje"]." as p where p.itemId = '".$id."' and p.dispensacion_id = '".$item_id."' and empresa_id = '" . $this->empresa_id. "'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id,$item_id){
        $campo_id="itemId";
        $where =  "dispensacion_id='" . $item_id . "' and i.empresa_id = " . $this->empresa_id;
        //$where = "dispensacion_id='".$item_id."' and empresa_id = '15'";
        $res = $this->item_delete_sbm($id,$campo_id,$this->tabla["mensaje"],$where);
        return $res;
    }

}