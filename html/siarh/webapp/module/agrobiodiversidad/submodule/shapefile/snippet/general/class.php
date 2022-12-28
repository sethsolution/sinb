<?php

class Snippet extends Table {
    //var $item_form;
    function __construct() {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    function get_item($idItem, $tipoTabla, $variante="") {
        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = '';
        if($idItem!=''){
            if($tipoTabla=='item'){
                $sqlSelect = ' i.*
                           , CONCAT_WS(" ",u1.nombre,u1.apellido) as userCreater
                           , CONCAT_WS(" ",u2.nombre,u2.apellido) as userUpdater';
                $sqlFrom = ' '.$this->tabla[$tipoTabla].' i
                         LEFT JOIN '.$this->tabla["o_usuario"].' u1 on u1.itemId=i.userCreate
                         LEFT JOIN '.$this->tabla["o_usuario"].' u2 on u2.itemId=i.userUpdate';
                $sqlWhere = ' i.itemId='.$idItem;
                $sqlGroup = ' GROUP BY i.itemId';
            }else{
                $sqlSelect = ' i.*';
                $sqlFrom = ' '.$this->tabla[$tipoTabla].' i ';
                $sqlWhere = ' i.itemId='.$idItem;
                $sqlGroup = '';
            }

            $sql = 'SELECT '.$sqlSelect.'
                  FROM '.$sqlFrom.'
                  WHERE '.$sqlWhere.'
                  '.$sqlGroup;
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        return $info;
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
    function item_update($rec, $itemId, $que_form, $accion, $tabla, $archivo_adjunto) {
        /**
         * preprocesamos los datos
         */
        $respuesta_procesa = $this->procesa_datos($que_form, $rec, $accion, $item_id);
        /**
         * Guardo los datos ya procesados
         */
        $campo_id="itemId";
        $where = "";
        $res = $this->item_update_sbm($itemId, $respuesta_procesa, $tabla, $accion, $campo_id, $where);
        $res["accion"] = $accion;
        /**
         * Procesamos el archivo
         */
        if( $res["res"]==1){
            $item = $this->get_item($res["id"], $tabla);
            $item_id = $item['itemId'];
            $adjunto = $this->item_adjunto_sbm($archivo_adjunto, $item_id, $res["id"], $item, $tabla, "update", 'itemId');
        }
        return $res;
    }

    /**
     * Función que valida los campos a ser guardados
     **/
    function procesa_datos($que_form, $rec, $accion="new") {
        $dato_resultado = array();
        switch($que_form){
            case 'campos_shapefiles':
                /**
                 * $rec = es el arreglo de datos que proviene del formulario, desde el frontend
                 * $$this->item_form = es el arreglo de configuraciòn de datos que se procesaran
                 * $accion = new, update
                 */
                $dato_resultado = $this->procesa_campos_sbm($rec, $this->campos[$que_form], $accion);
                break;

            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }

}