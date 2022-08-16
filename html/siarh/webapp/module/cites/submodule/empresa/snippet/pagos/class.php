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


    public function get_item_datatable_Rows($item_id){
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */

        $table = $this->tabla["empresa_pago"];
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
        $extraWhere = " i.empresa_id = ".$item_id." and i.categoria_id=1";
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
        foreach ($resultado['data'] as $itemId => $valor) {
            $resultado['data'][$itemId]['fecha_pago'] = date_format(date_create($valor['fecha_pago']),"d/m/Y");
            if($valor['observacion_fecha'] !="") $resultado['data'][$itemId]['observacion_fecha'] = date_format(date_create($valor['observacion_fecha']),"d/m/Y H:i:s");
            if($valor['aprobado_fecha'] !="") $resultado['data'][$itemId]['aprobado_fecha'] = date_format(date_create($valor['aprobado_fecha']),"d/m/Y H:i:s");
        }
        return $resultado;

    }

    function get_file($id,$item_id,$tipo){

        $msg_erro = "<div style='text-align: center;  background-color: #fee7dc;vertical-align: center; padding-top: 50px;padding-bottom: 50px;'><span style='color:red; font-family: Arial;font-size:26px;'>El Archivo No existe</span></div>";
        $item = $this->get_item($id,$item_id);

        $item_id = $item["empresa_id"];
        if($item["itemId"]!=""){
            $carpeta = "pagos";
            $dir  = $this->get_dir_item_archivo_sbm($item_id,0,$carpeta);

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

    function get_item($id,$item_id){


        $sql = "select p.*, e.observado from ".$this->tabla["empresa_pago"]." as p, empresa AS e where p.empresa_id = e.itemId 
            AND p.itemId = '".$id."' and empresa_id='".$item_id."' ";


        $item = $this->dbm->Execute($sql);
        $item = $item->fields;

        return $item;
    }


    function item_update($rec,$itemId,$que_form,$accion,$item_id){
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
            if(isset($rec["empresa_id"])) unset($rec["empresa_id"]);
            $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion,$item_id);

            /**
             * Guardo los datos ya procesados
             */
            $accion = 'update';
            //$item = $this->get_item($itemId,$item_id);
            //print_struc($item);exit;

            if($item["itemId"]!=""){
                if($item["estado_id"]==2 or $item["estado_id"]==3){
                    $tabla = $this->tabla["empresa_pago"];
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
                    $res['msg'] = "No se puede cambiar el estado del pago. El pago no se encuentra en estado enviado";
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
                //print_struc($dato_resultado);exit();
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
            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }

}