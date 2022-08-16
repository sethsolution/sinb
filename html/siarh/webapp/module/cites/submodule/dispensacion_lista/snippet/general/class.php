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
    function item_update($rec,$itemId,$que_form){
        /**
         * Sacamos los datos del item para su verificación
         */
        $accion ="update";
        $item = $this->get_item($itemId);


        if($item["estado_id"]==4){
            $res["res"] = 2;
            $res["msg"] = "Este certificado ya se encuentra Validado";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==1){
            $res["res"] = 2;
            $res["msg"] = "Este certificado no envio su registro todavia";
            $res['accion'] = $accion;
        }else if($item["itemId"]!="" and  $item["estado_id"]==2){
            /**
             * preprocesamos los datos
             */
            if (isset($rec["itemId"])) unset($rec["itemId"]);
            $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion,"");


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
     * Funcion que valida los campos a ser guardados
     **/
    function procesa_datos($que_form,$rec,$accion="new", $item_id){
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
                 * Cambiamos datos para registro de datos de usuarios de sistema
                 */
                if($dato_resultado["estado_id"]==3){
                    $dato_resultado["observacion_fecha"]= $dato_resultado["dateUpdate"];
                    $dato_resultado["observacion_user"]= $dato_resultado["userUpdate"];
                }

                if($dato_resultado["estado_id"]==4){
                    $dato_resultado["aprobado_fecha"]= $dato_resultado["dateUpdate"];
                    $dato_resultado["aprobado_user"]= $dato_resultado["userUpdate"];
                }

                $dato_resultado["dateUpdate_nucleo"]= $dato_resultado["dateUpdate"];
                $dato_resultado["userUpdate_nucleo"]= $dato_resultado["userUpdate"];

                if(isset($dato_resultado["dateUpdate"])) unset($dato_resultado["dateUpdate"]);
                if(isset($dato_resultado["userUpdate"])) unset($dato_resultado["userUpdate"]);

                break;
            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }

    function get_item($idItem){
        $info = '';
        if($idItem!=''){

            $sql = "SELECT
                    ct.nombre AS dispensacion_tipo
                    , ct.monto AS monto
                    , td.nombre as tipo
                    ,i.*
                    FROM ".$this->tabla["dispensacion"]." AS i
                    LEFT JOIN ".$this->tabla["c_dispensacion_tipo"]." AS ct ON ct.itemId = i.tipo_id
                    LEFT JOIN " . $this->tabla["c_tipo_documento"] . " AS td ON td.itemId = i.tipo_documento_id
                    WHERE i.itemId =  '".$idItem."' ";
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        return $info;
    }

    public function get_requisitos($item_id){
        $item1 = $this->get_item($item_id);
        $sql = "SELECT 
                    a.*
                    , cr.itemId AS tipo_requisito_id
                    , r.nombre AS nombre_requisito
                    , r.caducidad
                    , r.requerido
                    , r.categoria_id
                    , r.indice
                    FROM ".$this->tabla["c_dispensacion_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId and a.dispensacion_id= '".$item_id."'
                    WHERE cr.dispensacion_tipo_id = '".$item1['tipo_id']."'
                    AND r.categoria_id = 3  and a.adjunto_tamano > 0 ";

        $info = $this->dbm->execute($sql);
        $item = $info->getRows();

        return $item;
    }

}