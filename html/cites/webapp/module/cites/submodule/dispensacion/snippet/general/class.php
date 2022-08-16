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
    function item_update($rec,$itemId,$que_form,$accion)
    {
        /**
         * Sacamos los datos del item para su verificación
         */
        $item = $this->get_item($itemId);


            if ($item["estado_id"] == 4) {
                $res["res"] = 2;
                $res["msg"] = "Esta dispensación ya se encuentra Validado";
                $res['accion'] = $accion;
            } else if ($item["estado_id"] == 2) {
                $res["res"] = 2;
                $res["msg"] = "Esta dispensación esta en proceso de validación";
                $res['accion'] = $accion;
            } else if ($item["estado_id"] == 5 or $item["estado_id"] == 6) {
                $res["res"] = 2;
                $res["msg"] = "Esta dispensación fue rechazado o cancelado";
                $res['accion'] = $accion;
            } else if ($item["itemId"] != "" or $accion == "new") {
                /**
                 * preprocesamos los datos
                 */
                if (isset($rec["itemId"])) unset($rec["itemId"]);
                $respuesta_procesa = $this->procesa_datos($que_form, $rec, $item, $accion);

                /**
                 * Guardo los datos ya procesados
                 */
                $campo_id = "itemId";
                $where = "empresa_id='" . $this->empresa_id . "'";
                $res = $this->item_update_sbm($itemId, $respuesta_procesa, $this->tabla["dispensacion"], $accion, $campo_id, $where);
                $res["accion"] = $accion;
                if ($res["res"]) {}
            } else {
                $res["res"] = 2;
                $res["msg"] = "No existe los datos que quiere modificar";
                $res['accion'] = $accion;
            }


            return $res;
        }
        /**
         * Funcion que valida los campos a ser guardados
         **/
        function procesa_datos($que_form, $rec, $item, $accion = "new")
        {
            $dato_resultado = array();
            switch ($que_form) {
                case 'general':
                    /**
                     * $rec = es el arreglo de datos que proviene del formulario, desde el frontend
                     * $this->item_form = es el arreglo de configuraciòn de datos que se procesaran
                     * $accion = new, update
                     */
                    $dato_resultado = $this->procesa_campos_sbm($rec, $this->campos[$que_form], $accion);
                    /**
                     * Procesos Adicionales al momento de guardar los datos
                     */

                    $codigo = $this->get_ramdom_string(10);

                    if ($accion == "new") {
                        $dato_resultado["empresa_id"] = $this->empresa_id;
                        $dato_resultado["estado_id"] = 1;
                        $dato_resultado["codigo_qr_verificacion"] = $codigo;

                        //****************DATOS ADICIONADOS POR EL ADMINISTRADOR****************
                        $dato_resultado["autoridad_administrativa"] = "MINISTERIO DE MEDIO AMBIENTE Y AGUA  VICEMINISTERIO DE MEDIO AMBIENTE, BIODIVERSIDAD, CAMBIOS CLIMATICOS Y DE GESTION Y DESARROLLO FORESTAL 
Dirección General de Biodiversidad y      Áreas Protegidas
LA PAZ-BOLIVIA";
                        $dato_resultado["emitido_lugar"] = "LA PAZ";

                    } else {

                        if ($item["codigo_qr_verificacion"] == "") $dato_resultado["codigo_qr_verificacion"] = $codigo;
                        unset($dato_resultado["tipo_id"]);
                    }
                    break;
                case 'otros_formularios':
                    break;
            }
            return $dato_resultado;
        }

        function get_item($idItem){
            $info = '';
            if ($idItem != '') {

                $sql = "SELECT
                    ct.nombre AS dispensacion_tipo
                    , ct.monto AS monto
                    , td.nombre as tipo
                    ,i.*
                    FROM " . $this->tabla["dispensacion"] . " AS i
                    LEFT JOIN " . $this->tabla["c_dispensacion_tipo"] . " AS ct ON ct.itemId = i.tipo_id
                    LEFT JOIN " . $this->tabla["c_tipo_documento"] . " AS td ON td.itemId = i.tipo_documento_id
                    WHERE i.itemId =  '" . $idItem . "'
                    AND i.empresa_id = '" . $this->empresa_id . "'";
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
                    AND a.empresa_id = '".$this->empresa_id."'
                    WHERE cr.dispensacion_tipo_id = '".$item1['tipo_id']."'
                    AND r.categoria_id = 3  and a.adjunto_tamano > 0 ";

        $info = $this->dbm->execute($sql);
        $item = $info->getRows();

        return $item;
    }
}
