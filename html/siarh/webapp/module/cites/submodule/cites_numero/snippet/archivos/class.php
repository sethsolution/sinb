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
        $table = $this->tabla["cartera_archivo"];
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
        $extraWhere = "cartera_id='".$item_id."'";
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
    function item_update($rec,$itemId,$que_form,$accion,$item_id,$input_archivo){
        $tabla = $this->tabla["cartera_archivo"];
        /**
         * preprocesamos los datos
         */
        $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion,$item_id);
        /**
         * Guardo los datos ya procesados
         */
        $campo_id="itemId";
        $where = "cartera_id='".$item_id."'";
        $res = $this->item_update_sbm($itemId,$respuesta_procesa,$tabla,$accion,$campo_id,$where);
        $res["accion"] = $accion;
        /**
         * Procesamos el archivo
         */
        if( $res["res"]==1){
            $item = $this->get_item($res["id"],$item_id);
            $adjunto = $this->item_adjunto_sbm($input_archivo,$item_id,$res["id"],$item,$tabla,$accion,"cartera_id");
        }
        return $res;
    }

    /**
     * Funcion que valida los campos a ser guardados
     **/
    function procesa_datos($que_form,$rec,$accion="new",$item_id){
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
                $dato_resultado["cartera_id"] = $item_id;
                break;
            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }

    function get_item($id,$item_id){
        $sql = "select * from ".$this->tabla["cartera_archivo"]." as p where p.itemId = '".$id."' and p.cartera_id = '".$item_id."'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

    function get_file($id,$item_id){
        $item = $this->get_item($id,$item_id);
        if($item["itemId"]!=""){
            $dir  = $this->get_dir_item_archivo_sbm($item_id);
            $archivo = $dir.$id.".".$item["adjunto_extension"];
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
            echo "<center><b><font color='red' face='arial'>El Archivo No existe</font></b></center>";
        }
        exit;
    }
    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id,$item_id){
        /**
         * borramos el archivo primero
         */
        $this->item_delete_archivo_sbm($id,$item_id);
        /**
         * Luego borrarmos el registro de la base de datos
         */
        $campo_id="itemId";
        $where = "cartera_id='".$item_id."'";
        $res = $this->item_delete_sbm($id,$campo_id,$this->tabla["cartera_archivo"],$where);

        return $res;
    }

}