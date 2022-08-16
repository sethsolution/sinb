<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:23
 */
use Dompdf\Dompdf;

class Index extends Table {

    function __construct()
    {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    public function get_item_datatable_Rows(){
        global $db_conf_datatable;
        //print_struc($this);exit();
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
        $grilla = "index";
        /**
         * la configuración de base de datos que utilizaremos
         * que se la realiza en inc/db.php
         */
        $db=$db_conf_datatable["principal"];
        /**
         * Configuraciones adicionales
         */
        //print_struc($this->userId);exit;
        $extraWhere = " empresa_id= '".$this->empresa_id."' and estado_id = '4'";
        $groupBy = "";
        $having = "";
        /**
         * Resultado de la consulta enviada
         */
        $resultado = $this->get_grilla_datatable_simple($db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having);
        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */
        return $resultado;
    }

    function get_item($idItem){
        $info = '';
        if($idItem!=''){

            $sql = "SELECT
ct.nombre AS cites_tipo
,e.nombre as estado
, ct.monto AS monto
,i.*
FROM ".$this->tabla["cites"]." AS i
LEFT JOIN ".$this->tabla["c_cites_tipo"]." AS ct ON ct.itemId = i.tipo_id
left join ".$this->tabla["c_estado"]." AS e ON e.itemId = i.estado_id
WHERE i.itemId =  '".$idItem."'
AND i.empresa_id = '" . $this->empresa_id. "'";

            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        return $info;
    }



    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id){
        /**
         * borramos a los hijos antes de borrar al principal
         */
        /*
        $sql ="delete from  ".$this->tabla["convenio_ejecutora"]." where item_convenio_id='".$id."' ";
        $this->dbm->execute($sql);
        /*
        /**
         * borramos  el dato principal
         */
        $campo_id="itemId";
        $where =  " empresa_id = '" . $this->empresa_id;
        $res = $this->item_delete_sbm($id,$campo_id,$this->tabla["cites"], $where);
        return $res;
    }
}