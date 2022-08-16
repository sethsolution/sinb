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

    function get_item1($idItem){


        $info = '';
        if($idItem!=''){
            $sql = "SELECT * FROM ".$this->tabla["dispensacion"]." as i WHERE i.itemId='".$idItem."' ";
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        return $info;
    }


    function get_item($idItem){
        $info = '';
        if($idItem!=''){

            $sql = "SELECT
ct.nombre AS dispensacion_tipo
, ct.monto AS monto
,i.*
FROM ".$this->tabla["dispensacion"]." AS i
LEFT JOIN ".$this->tabla["c_dispensacion_tipo"]." AS ct ON ct.itemId = i.tipo_id
WHERE i.itemId =  '".$idItem."'
AND i.empresa_id = '" . $this->empresa_id. "'";

            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        return $info;
    }


    public function get_item_datatable_Rows(){
        global $db_conf_datatable;
        //print_struc($this);exit();
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["dispensacion"];
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
        $extraWhere = " empresa_id= '".$this->empresa_id."' and estado_id = 4";
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

    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id){
        /**
         * borramos a los hijos antes de borrar al principal
         */
        $campo_id="itemId";
        $res = $this->item_delete_sbm($id,$campo_id,$this->tabla["dispensacion"]);
        return $res;
    }

    /**
     * Get Resumen
     */
    function get_resumen($idItem){

        $sql = "SELECT
                ct.nombre AS dispensacion_tipo
                , e.nombre as estado
                , ct.monto AS monto
                , (SELECT SUM(p.monto)  FROM empresa_pago AS p WHERE p.dispensacion_id = i.itemId AND p.empresa_id = i.empresa_id) AS total_depositado
                , (SELECT COUNT(*)  FROM dispensacion_especie AS e WHERE e.dispensacion_id = i.itemId AND e.empresa_id = i.empresa_id) AS total_especie
                
                FROM ".$this->tabla["dispensacion"]." AS i
                LEFT JOIN ".$this->tabla["c_dispensacion_tipo"]." AS ct ON ct.itemId = i.tipo_id
                left join ".$this->tabla["c_estado"]." AS e ON e.itemId = i.estado_id
                WHERE i.itemId =  '".$idItem."'
                AND i.empresa_id = '" . $this->empresa_id. "'";

        $info = $this->dbm->Execute($sql);
        $item = $info->fields;
        /**
         * Sacamos la cantidad certificados que deberia generar y pagar
         */
        $especie_max = 6;
        $especie  = $item["total_especie"];
        $cert_entero = floor($especie / $especie_max);
        $cert_resto = $especie  % $especie_max;
        /**
         * Calcula la cantidad de certificados necesarios
         */
        if($cert_resto==0){
            $total_certificado = $cert_entero;
        }else{
            $total_certificado = $cert_entero + 1;
        }
        /**
         * Calculamos el total a pagar
         */
        $total_depositar = $total_certificado * $item["monto"];
        /**
         * añadir datos al arreglo
         */
        $item["total_certificado"] = $total_certificado;
        $item["total_depositar"] = $total_depositar;
        //$dato["desembolsado"] = round($info["monto"],2);
        return $item;

    }
}