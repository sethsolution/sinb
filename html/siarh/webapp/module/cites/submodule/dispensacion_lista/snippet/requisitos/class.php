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
                    FROM ".$this->tabla["c_dispensacion_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId and a.dispensacion_id= '".$item_id."'
                    
                    WHERE cr.dispensacion_tipo_id = '".$tipo_id."'
                    AND r.categoria_id = 3 ";

        $info = $this->dbm->execute($sql);
        $item = $info->getRows();

        return $item;
    }
    public function get_requisito($item_id,$tipo_id){

        $item = $this->get_requisito_list($tipo_id,$item_id);

        $creo = 0;

        foreach ($item as $row){
            if($row["itemId"] =="" and $row["tipo_requisito_id"]!=""){
                /**
                 * Si no existe el registro en la tabla empresa_archivo, crearemos uno
                 */
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
                    left  JOIN ".$this->tabla["archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId 
                    
                    WHERE cr.dispensacion_tipo_id = '".$tipo_id."'
                    AND r.categoria_id = 3";
                $rec = array();
                $rec["dateCreate"] = $rec["dateUpdate"] =  date("Y-m-d H:i:s");
                $rec["userCreate"] = $rec["userUpdate"] = $this->userId;
                $rec["tipo_requisito_id"] = $row["tipo_requisito_id"];
                $rec["nombre"] = $row["nombre_requisito"];
                $rec["dispensacion_id"] = $item_id;
                $rec["estado_id"] = 1;
                $this->dbm->autoExecute($this->tabla["archivo"],$rec);
                $creo = 1;
            }
        }
        if($creo){
            $item = $this->get_requisito_list($tipo_id,$item_id);
        }
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
        $extraWhere = "dispensacion_id='".$item_id."'";
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

        $sql = "select * from ".$this->tabla["dispensacion"]." where itemId= '".$item_id."'  ";
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
                    FROM ".$this->tabla["c_dispensacion_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId 
                    
                    WHERE cr.dispensacion_tipo_id = '".$tipo_id."'
                    AND r.categoria_id = 3 AND a.itemId = '".$id."' and dispensacion_id='".$item_id."' ";


        $info = $this->dbm->execute($sql);
        $item = $info->fields;
        return $item;
    }

    function get_file($id,$item_id,$tipo){
        $msg_erro = "<div style='text-align: center;  background-color: #fee7dc;vertical-align: center; padding-top: 50px;padding-bottom: 50px;'><span style='color:red; font-family: Arial;font-size:26px;'>El Archivo No existe</span></div>";
        $item = $this->get_item($id,$item_id);

        if($item["itemId"]!=""){
            $dir  = $this->get_dir_item_archivo_sbm($item_id,0,"requisitos");
            $archivo = $dir.$id.".".$item["adjunto_extension"];
            if(file_exists($archivo)){
                header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
                header ("Cache-Control: no-cache, must-revalidate");
                header ("Pragma: no-cache");
                header ("Content-Type:".$item["adjunto_tipo"]);
                if($tipo=="inline"){
                    $tipo = "inline";
                }else{
                    $tipo = "attachment";
                }
                header ('Content-Disposition: '.$tipo.'; filename="'.$item["adjunto_nombre"].'"');
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
    function item_update($rec,$itemId,$que_form,$item_id){

        /**
         * Verificamos primero el estado de la cite antes de guardar todos los datos
         * el estado del padre es el que manda al momento de guardar los datos
         */
        $item = $this->get_item_detalle($item_id);
        $bandera = 0;
        if($item["estado_id"]==4){
            $res["res"] = 2;
            $res["msg"] = "Este certificado de dispensacion esta registrado oficialmente";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==1){
            $res["res"] = 2;
            $res["msg"] = "Este certificado de dispensacion se encuentra en proceso de Registro";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==3){
            $res["res"] = 2;
            $res["msg"] = "Este certificado de dispensacion se encuentra en estado Observado";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==5 or $item["estado_id"]==6 ){
            $res["res"] = 2;
            $res["msg"] = "Este certificado de dispensacion fue rechazado o cancelado";
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
            $accion ="update";
            if(isset($rec["dispensacion_id"])) unset($rec["dispensacion_id"]);
            $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion,$item_id);

            /**
             * Recuperamos los datos del item, para verificar si existe
             */

            $item = $this->get_item($itemId,$item_id);

            if($item["itemId"]!=""){
                if($item["estado_id"]==1 or $item["estado_id"]==3){
                $tabla = $this->tabla["archivo"];
                /**
                 * Guardo los datos ya procesados
                 */
                $campo_id="itemId";
                $where = "dispensacion_id='".$item_id."' ";
                $res = $this->item_update_sbm($itemId,$respuesta_procesa,$tabla,$accion,$campo_id,$where);
                $res["accion"] = $accion;

                /**
                 * Procesamos el archivo
                 */
                if( $res["res"]==1){
                }
                }else{
                    $res['res'] = 2;
                    $res['msg'] = "No se puede cambiar el estado del documento. Ya se cambio de estado";
                    $res['accion'] = $accion;
                }
            }else{
                $res['res'] = 2;
                $res['msg'] = "El registro que quiere cambiar de estado no existe.";
                $res['accion'] = $accion;
            }

        }

        return $res;
    }
    /**
     * Funcion que valida los campos a ser guardados
     **/
    function procesa_datos($que_form,$rec,$accion="new"){

        $dato_resultado = array();
        switch($que_form){
            case 'archivo':
                /**
                 * $rec = es el arreglo de datos que proviene del formulario, desde el frontend
                 * $$this->item_form = es el arreglo de configuraciòn de datos que se procesaran
                 * $accion = new, update
                 */
                $dato_resultado = $this->procesa_campos_sbm($rec,$this->campos[$que_form],$accion);
                //print_struc($rec);exit();
                /**
                 * Procesos Adicionales al momento de guardar los datos
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

    function item_update_detalle($rec,$item_id,$que_form){
        /**
         * ItemId será el mismo is del usuario
         */
        $itemId= $item_id;
        $accion ="update";
        $item = $this->get_item_detalle($itemId);

        if($item["estado_id"]==4){
            $res["res"] = 2;
            $res["msg"] = "Este certificado ya se encuentra Validado";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==5 or $item["estado_id"]==6 ){
            $res["res"] = 2;
            $res["msg"] = "Este certificado fue rechazado o cancelado";
            $res['accion'] = $accion;
        }else if($item["itemId"]!="" and  $item["estado_id"]==2){
            /**
             * preprocesamos los datos
             */
            if (isset($rec["itemId"])) unset($rec["itemId"]);
            $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion);

            /**
             * Guardo los datos ya procesados
             */
            $campo_id="itemId";
            $where = "";
            $res = $this->item_update_sbm($itemId,$respuesta_procesa,$this->tabla["dispensacion"],$accion,$campo_id,$where);
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