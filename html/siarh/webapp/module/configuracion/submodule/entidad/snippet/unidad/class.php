<?php
class Snippet extends Table
{
    var $carpeta;

    function __construct()
    {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    /**
     * Implementación desde aca
     */

    public function get_item_datatable_Rows($item_id)
    {
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["unidad"];
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
        $db = $db_conf_datatable["principal"];
        /**
         * Configuraciones adicionales
         */

        /**
         * ---------------------------------------------
         * hacer un query previo, que saque todos los ids de la direcciones.
         *
         */
        $direccion = $this->get_direcciones($item_id);

        $extraWhere = " i.direccion_id in (" . $direccion["ids"] . ") ";
        // echo $extraWhere;
        // exit;
        //$extraWhere = "";

        $groupBy = "";
        $having = "";

        /**
         * Resultado de la consulta enviada
         */
        $resultado = $this->get_grilla_datatable_simple($db, $grilla, $table, $primaryKey, $extraWhere, $groupBy, $having);
        $resultado["recordsTotal"] = $resultado["recordsFiltered"];

        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */
        return $resultado;
    }

    function get_direcciones($item_id)
    {
        // $this->dbm->debug = true;
        $sql = "select GROUP_CONCAT(d.itemId) as ids
        from " . $this->tabla["direccion"] . " as d
        where d.entidad_id=$item_id";

        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
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
    function item_update($rec, $itemId, $que_form, $accion, $item_id)
    {
        //echo "hola";
        //$this->dbm->debug = true;
        $tabla = $this->tabla["unidad"];
        /**
         * preprocesamos los datos
         */
        $respuesta_procesa = $this->procesa_datos($que_form, $rec, $accion, $item_id);
        //print_struc($respuesta_procesa);

        /**
         * Guardo los datos ya procesados
         */
        $campo_id = "itemId";
        $where = "direccion_id='".$item_id."'";
        $res = $this->item_update_sbm($itemId, $respuesta_procesa, $tabla, $accion, $campo_id);
        $res["accion"] = $accion;
        /**
         * Procesamos el archivo
         */

        return $res;
    }

    /**
     * Funcion que valida los campos a ser guardados
     **/
    function procesa_datos($que_form, $rec, $accion = "new", $item_id)
    {
        $dato_resultado = array();
        switch ($que_form) {
            case 'archivo':
                /**
                 * $rec = es el arreglo de datos que proviene del formulario, desde el frontend
                 * $$this->item_form = es el arreglo de configuraciòn de datos que se procesaran
                 * $accion = new, update
                 */
                $dato_resultado = $this->procesa_campos_sbm($rec, $this->campos[$que_form], $accion);

                /**
                 * Procesos Adicionales al momento de guardar los datos
                 */
                if ($accion == "new") {
                    $dato_resultado["activo"] = 1;
                    $dato_resultado["direccion_id"] = $item_id;

                }

                break;
        }
        return $dato_resultado;
    }

    function get_item($id, $item_id)
    {
        $direccion = $this->get_direcciones($item_id);
        //$this->dbm->debug = true;
        $sql = "select * from " . $this->tabla["unidad"] . " as p where p.itemId = '" . $id . "' and p.direccion_id in (" . $direccion["ids"] . ") = '" . $item_id . "'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id, $item_id)
    {
        /**
         * borramos el archivo primero
         */
        $this->item_delete_archivo_sbm($id, $item_id, $this->carpeta);
        /**
         * Luego borrarmos el registro de la base de datos
         */
        $campo_id = "itemId";
        $where = "direccion_id='" . $item_id . "'";
        $res = $this->item_delete_sbm($id, $campo_id, $this->tabla["unidad"], $where);

        return $res;

    }

}