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


    function get_item_detalle($id){
        $sql = " select * from ".$this->tabla["empresa"]." where itemId= '".$id."' ";
        $info = $this->dbm->Execute($sql);
        $info = $info->fields;
        return $info;
    }


    public function get_requisito($item){

        $sql= "SELECT 
                 a.*
                , er.itemId AS tipo_requisito_id
                , r.nombre AS nombre_requisito
                , r.caducidad
                , r.requerido
                , r.categoria_id
                , r.indice
                FROM ".$this->tabla["c_empresa_tipo_requisito"]." AS er 
                LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = er.requisito_id 
                left  JOIN ".$this->tabla["empresa_archivo"]." AS a ON a.tipo_requisito_id = er.itemId AND a.empresa_id = '".$item["itemId"]."'
                WHERE er.empresa_tipo_id = '".$item["tipo_id"]."'
                AND r.categoria_id = 1 AND r.activo = 1";


        $info = $this->dbm->execute($sql);
        $item = $info->getRows();

        return $item;
    }

    function get_item($id,$item_id){
        global $objItem;
        $empresa = $objItem->get_item($item_id);

        /**
         * Verificamos si el requisito pertenece al tipo de empresa
         */
        $sql= "SELECT 
                 a.*
                , er.itemId AS tipo_requisito_id
                , r.nombre AS nombre_requisito
                , r.caducidad
                , r.requerido
                , r.categoria_id
                , r.indice
                FROM ".$this->tabla["c_empresa_tipo_requisito"]." AS er 
                LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = er.requisito_id 
                left  JOIN ".$this->tabla["empresa_archivo"]." AS a ON a.tipo_requisito_id = er.itemId AND a.empresa_id = '".$item_id."'
                WHERE er.empresa_tipo_id = '".$empresa["tipo_id"]."'
                AND r.categoria_id = 1 AND a.itemId = '".$id."'";
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


    function item_update($rec,$itemId,$que_form,$item_id){

        global $objItem;

        /**
         * Sacamos los datos del padre
         */
        $item = $objItem->get_item($item_id);

        $bandera = 0;
        if($item["estado_id"]==4){
            $res["res"] = 2;
            $res["msg"] = "Este usuario esta registrado oficialmente";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==1){
            $res["res"] = 2;
            $res["msg"] = "Este usuario se encuentra en proceso de Registro";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==3){
            $res["res"] = 2;
            $res["msg"] = "Este usuario se encuentra en estado Observado";
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
            $accion ="update";
            if(isset($rec["empresa_id"])) unset($rec["empresa_id"]);
            $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion,$item_id);

            $item = $this->get_item($itemId,$item_id);


            if($item["itemId"]!=""){
                if($item["estado_id"]==1 or $item["estado_id"]==3){
                    $tabla = $this->tabla["empresa_archivo"];
                    $campo_id="itemId";
                    $where = " empresa_id = ".$item_id ;
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
    function procesa_datos($que_form,$rec,$accion="new",$item_id){
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

                if($dato_resultado["requisitos_observado"]==1){

                    $dato_resultado["dateUpdate_nucleo"]= $dato_resultado["dateUpdate"];
                    $dato_resultado["userUpdate_nucleo"]= $dato_resultado["userUpdate"];
                    $dato_resultado["requisitos_fecha"]= $dato_resultado["dateUpdate"];

                }

                if(isset($dato_resultado["dateUpdate"])) unset($dato_resultado["dateUpdate"]);
                if(isset($dato_resultado["userUpdate"])) unset($dato_resultado["userUpdate"]);

                break;
        }
        return $dato_resultado;
    }



    function item_update_detalle($rec,$itemId,$que_form){
        /**
         * ItemId será el mismo is del usuario
         */
        $accion ="update";
        $item = $this->get_item_detalle($itemId);


        if($item["estado_id"]==4){
            $res["res"] = 2;
            $res["msg"] = "Esta empresa ya se encuentra Validado";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==1){
            $res["res"] = 2;
            $res["msg"] = "Esta empresa no envio su registro todavia";
            $res['accion'] = $accion;
        }else if($item["estado_id"]==3){
            $res["res"] = 2;
            $res["msg"] = "Esta empresa se encuentra observada";
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
            $res = $this->item_update_sbm($itemId,$respuesta_procesa,$this->tabla["empresa"],$accion,$campo_id);
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