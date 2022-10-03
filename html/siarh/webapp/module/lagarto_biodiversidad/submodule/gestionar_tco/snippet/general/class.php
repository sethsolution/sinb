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
    function item_update($rec,$itemId,$que_form,$accion){
        /**
         * preprocesamos los datos
         */
        $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion);
        /**
         * Guardo los datos ya procesados
         */
        $campo_id="itemId";
        $where="";
        $ver=$this->verificar_permiso_usuarios(["1"]);
        if($ver)
        {
            
            if($accion==="update"){
                unset($respuesta_procesa["municipio_itemId"]);
            }
            $res = $this->item_update_sbm($itemId,$respuesta_procesa,$que_form,$accion,$campo_id,$where);}
        else{
            
            $res["res"] = 2;
            $res["msg"] = "No se logro actualizar la informacion en la B.D.";
            $res["msgdb"] = $this->dbm->ErrorMsg();
        }
        $res["accion"] = $accion;

        return $res;
    }
    /**
     * Funcion que valida los campos a ser guardados
     **/
    function procesa_datos($que_form,$rec,$accion="new"){
        $dato_resultado = array();
        $dato_resultado = $this->procesa_campos_sbm($rec,$this->campos[$que_form],$accion);
        return $dato_resultado;
    }
    
    /**
	 * Table::subirFotoServidor()
	 * 
	 * @param mixed $rol_Id
	 * @return boolean
	 */
    
}