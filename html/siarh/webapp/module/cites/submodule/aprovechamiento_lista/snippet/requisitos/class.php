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

    public function get_requisito_list($tipo_id,$item_id){

        $sql = "SELECT 
                    a.*
                    , cr.itemId AS tipo_requisito_id
                    , r.nombre AS nombre_requisito
                    , r.caducidad
                    , r.requerido
                    , r.categoria_id
                    , r.indice
                    FROM ".$this->tabla["c_aprovechamiento_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId and a.aprovechamiento_id= '".$item_id."'
                    
                    WHERE cr.aprovechamiento_tipo_id = '1'
                    AND r.categoria_id = 8 
                    order by r.requerido desc
                    ";

        $info = $this->dbm->execute($sql);
        $item = $info->getRows();

        return $item;
    }
    public function get_requisito($item_id,$tipo_id){

        $item = $this->get_requisito_list($tipo_id,$item_id);

        return $item;
    }


    public function get_item_datatable_Rows($item_id){
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */

        $table = $this->tabla["archivo"];
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
        $extraWhere = "aprovechamiento_id = '".$item_id."'";
        $groupBy = "";
        $having = "";
        //print_struc($db);exit();
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

    function get_item_detalle($item_id){

        $sql = "select * from ".$this->tabla["aprovechamiento"]." where itemId= '".$item_id."'";
        $info = $this->dbm->Execute($sql);
        $info = $info->fields;
        return $info;
    }

    function get_item($id,$item_id){
        /**
         * Verificamos si el requisito pertenece al tipo de empresa
         */
        $item = $this->get_item_detalle($item_id);
        $tipo_id = $item["tipo_id"];
        $sql = "SELECT 
                    a.*
                    , cr.itemId AS tipo_requisito_id
                    , r.nombre AS nombre_requisito
                    , r.caducidad
                    , r.requerido
                    , r.categoria_id
                    , r.indice
                    FROM ".$this->tabla["c_aprovechamiento_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId 
                    WHERE cr.aprovechamiento_tipo_id = '".$tipo_id."'
                    AND r.categoria_id = 8 AND a.itemId = '".$id."' and aprovechamiento_id='".$item_id."' ";


        $info = $this->dbm->execute($sql);
        $item = $info->fields;
        return $item;
    }

    function get_file($id,$item_id){
        $msg_erro = "<div style='text-align: center;  background-color: #fee7dc;vertical-align: center; padding-top: 50px;padding-bottom: 50px;'><span style='color:red; font-family: Arial;font-size:26px;'>El Archivo No existe</span></div>";
        $item = $this->get_item($id,$item_id);
        //$item_id = $this->empresa_id;

        if($item["itemId"]!=""){
            $dir  = $this->get_dir_item_archivo_sbm($item_id,0,"requisitos");
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
     * Function que actualiza la informacion de datos de un registro
     * $respuesta = $subObjItem->item_update($item,$itemId,0);
     * $rec = arreglo de datos que llega del formulario
     * $itemId= el id del reguistro que quiero actualizar
     * $que_form = El formulario dentro que quiero actualizar, "Es el mismo nombre del grupo de campos que quiero validar"
     * $accion = new, update ,  solo existen 2 acciones
     *
     **/
    function item_update($rec,$itemId,$que_form,$accion,$item_id,$input_archivo){

        /**
         * Verificamos primero el estado antes de guardar todos los datos
         * el estado del padre es el que manda al momento de guardar los datos
         */
        $item = $this->get_item_detalle($item_id);
        $bandera = 0;
        if($item["estado_id"]==4){
            $res["res"] = 2;
            $res["msg"] = "Este reporte ya se encuentra Validado";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==2){
            $res["res"] = 2;
            $res["msg"] = "Este reporte esta en proceso de validación";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==5 or $item["estado_id"]==6 ){
            $res["res"] = 2;
            $res["msg"] = "Este reporte fue rechazado o cancelado";
            $res['accion'] = $accion;
        }else if($item["itemId"]!=""){
            $bandera = 1;
        }else{
            $res["res"] = 2;
            $res["msg"] = "No existe los datos que quiere modificar";
            $res['accion'] = $accion;
        }

        /**
         * Iniciamos el proceso de guardado de datos de la información del requisito
         */
        if($bandera==1){
            /**
             * preprocesamos los datos
             */
            if(isset($rec["empresa_id"])) unset($rec["empresa_id"]);
            $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion,$item_id);

            /**
             * Recuperamos los datos del item, para verificar si existe
             */
            $item = $this->get_item($itemId,$item_id);

            if($item["estado_id"]==4){
                $res["res"] = 2;
                $res["msg"] = "Este documento ya se encuentra verificado";
            }else if($item["itemId"]!=""){
                $tabla = $this->tabla["archivo"];
                /**
                 * Guardo los datos ya procesados
                 */
                $campo_id="itemId";
                $where = "aprovechamiento_id='".$item_id."'" ;
                $res = $this->item_update_sbm($itemId,$respuesta_procesa,$tabla,$accion,$campo_id,$where);
                $res["accion"] = $accion;

                /**
                 * Procesamos el archivo
                 */
                if( $res["res"]==1){
                    $item = $this->get_item($res["id"],$item_id);
                    $adjunto = $this->item_adjunto_sbm($input_archivo,$item_id,$res["id"],$item,$tabla,$accion,"aprovechamiento_id","requisitos");
                }
            }else{
                $res["res"] = 2;
                $res["msg"] = "No existe los datos que quiere modificar";
            }

        }

        return $res;
    }
    /**
     * Funcion que valida los campos a ser guardados
     **/
    function procesa_datos($que_form,$rec,$accion="new"){
        //print_struc($rec);exit();
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
                $dato_resultado['estado_id'] = 1;

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
                 */
                if ($accion=="new"){

                }
                /**
                 * cambia la bandera a 1 , para saber que guardo datos adicionales
                 */
                $dato_resultado["requisitos_datos"] = 1;

                break;
            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }

    function item_update_detalle($rec,$item_id,$que_form){
        /**
         * ItemId será el mismo is del usuario
         */
        $itemId= $item_id;
        $accion ="update";
        $item = $this->get_item_detalle($itemId);

        if($item["estado_id"]==4){
            $res["res"] = 2;
            $res["msg"] = "Este reporte ya se encuentra Validado";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==2){
            $res["res"] = 2;
            $res["msg"] = "Este reporte esta en proceso de validación";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==5 or $item["estado_id"]==6 ){
            $res["res"] = 2;
            $res["msg"] = "Este reporte fue rechazado o cancelado";
            $res['accion'] = $accion;
        }else if($item["itemId"]!="" or $accion=="new"){
            /**
             * preprocesamos los datos
             */
            if (isset($rec["itemId"])) unset($rec["itemId"]);
            $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion);

            /**
             * Guardo los datos ya procesados
             */
            $campo_id="itemId";
            $where = " ";
            $res = $this->item_update_sbm($itemId,$respuesta_procesa,$this->tabla["aprovechamiento"],$accion,$campo_id,$where);
            $res["accion"] = $accion;

            if($res["res"]){}
        }else{
            $res["res"] = 2;
            $res["msg"] = "No existe los datos que quiere modificar";
            $res['accion'] = $accion;
        }

        return $res;
    }


}