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
     * Implementación el get listado de registro_numero
     */

    public function get_item_datatable_Rows($item_id)
    {
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */

        $table = $this->tabla["registro_numero"];
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
        $db = $db_conf_datatable["principal"];
        /**
         * Configuraciones adicionales
         */
        $extraWhere = "registro_id='" . $item_id . "'";
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

    /**
     * Function que actualiza la informacion de datos de un registro
     * $respuesta = $subObjItem->item_update($item,$itemId,0);
     * $rec = arreglo de datos que llega del formulario
     * $itemId= el id del reguistro que quiero actualizar
     * $que_form = El formulario dentro que quiero actualizar, "Es el mismo nombre del grupo de campos que quiero validar"
     * $accion = new, update ,  solo existen 2 acciones
     *
     **/
    function item_update($rec,$itemId,$que_form,$accion){

        /**
         * preprocesamos los datos
         */

        $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion);
        //print_struc($respuesta_procesa);
        /**
         * Guardo los datos ya procesados
         */
        $campo_id="itemId";
        $res = $this->item_update_sbm($itemId,$respuesta_procesa,$this->tabla["registro"],$accion,$campo_id);
        $res["accion"] = $accion;

        /**
         * Guardar datos
         */
        if($res["res"]){}
            while ($rec['numero_inicio'] <= $rec['numero_fin']) {
                $num = array();
                $num["dateCreate"] = $num["dateUpdate"] =  date("Y-m-d H:i:s");
                $num["userCreate"] = $num["userUpdate"] = $this->userId;
                $num['numero'] = $rec['numero_inicio'];
                $num ['tipo'] = 2;
                $num ['registro_id'] = $res["id"];

                $this->dbm->AutoExecute($this->tabla["numero"],$num);
                $rec['numero_inicio'] += 1;

            }
        


        return $res;
    }
    /**
     * Funcion que valida los campos a ser guardados
     **/
    function procesa_datos($que_form,$rec,$accion="new"){
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
                 * Procesos Adicionales al momento de guardar los datos
                 */

                if ($accion=="new"){
                    $dato_resultado["tipo"] = 2;
                }
                break;

            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }

}