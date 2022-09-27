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

        $table = $this->tabla["cites"];
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
        //$extraWhere = " i.empresa_id = ".$this->empresa_id." and i.categoria_id=2 and i.cites_id='".$item_id."' ";
        $extraWhere = " i.cites_id='".$item_id."' ";

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
        return $resultado;

    }





    function get_item($id,$item_id, $all=0){
        if($all == 0){
            $sql = "select * from ".$this->tabla["empresa_pago"]." as p where p.itemId = '".$id."' 
        and empresa_id = '" . $this->empresa_id. "' and categoria_id= '2' and cites_id='".$item_id."'";
        }else{
            $sql = "select * from ".$this->tabla["empresa_pago"]." as p where p.itemId = '".$id."' 
        and empresa_id = '" . $this->empresa_id. "' and cites_id='".$item_id."'";
        }
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;

        /**
         * si se puede modificar el registro o no
         */
        if( ($item['itemId'] != "" and  $item['categoria_id']==2)
            and ( $item['estado_id'] == 1 or  $item['estado_id'] == 3)
        ){
            $item["modifica"]=1;
        }else{
            $item["modifica"]=0;
        }
        return $item;
    }

}