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

    public function get_item_datatable_Rows(){
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["c_tipo_documento"];  //
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = 'itemId';
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "catalogo";
        /**
         * la configuración de base de datos que utilizaremos
         * que se la realiza en inc/db.php
         */
        $db=$db_conf_datatable["principal"];
        /**
         * Configuraciones adicionales
         */
        $extraWhere = "";
        $groupBy = "";
        $having = "";
        /**
         * Resultado de la consulta enviada
         */
        $resultado = $this->get_grilla_datatable_simple($db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having);
        //print_struc($resultado); exit;
        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */
        return $resultado;

    }



    function get_item($id){
        $sql = "select * from ".$this->tabla["c_tipo_documento"]." as p where p.itemId = '".$id."'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

    function consulta($item){

        $sql = "SELECT 
e.nombre
, a.numero_informe


,
(
SELECT GROUP_CONCAT(a2.anio)
FROM
(
SELECT u.anio
FROM aprovechamiento_utilizado AS u 
WHERE u.aprovechamiento_id = itemId 
GROUP BY u.anio
) AS a2
) AS gestion

, (SELECT sum(c.numero_envase) FROM aprovechamiento_conteo AS c 
WHERE c.aprovechamiento_id = a.itemId)
AS cantidad_envases
, (SELECT MIN(u.precinto_inicial) FROM aprovechamiento_utilizado AS u WHERE u.aprovechamiento_id = a.itemId )
AS precinto_inicial
, (SELECT max(u.precinto_final) FROM aprovechamiento_utilizado AS u WHERE u.aprovechamiento_id = a.itemId )
AS precinto_final
, (SELECT sum(u.precinto_final - u.precinto_inicial) FROM aprovechamiento_utilizado AS u WHERE u.aprovechamiento_id = a.itemId )
AS precinto_utilizados

, (SELECT sum(u.precinto_total_utilizados) FROM aprovechamiento_utilizado AS u WHERE u.aprovechamiento_id = a.itemId )
AS precinto_utilizados
, (SELECT sum(u.precinto_total_noutilizados) FROM aprovechamiento_utilizado AS u WHERE u.aprovechamiento_id = a.itemId )
AS precinto_noutilizados

, (SELECT group_concat(u.codigo_precintos_baja) FROM aprovechamiento_utilizado AS u WHERE u.aprovechamiento_id = a.itemId )
AS precinto_codigo_baja
, a.codigo_utilizado
, (SELECT SUM(c.peso_bruto) FROM aprovechamiento_conteo AS c 
WHERE c.aprovechamiento_id = a.itemId)
AS peso_bruto

, (SELECT SUM(c.peso_neto) FROM aprovechamiento_conteo AS c 
WHERE c.aprovechamiento_id = a.itemId)
AS peso_neto

, (SELECT SUM(c.equivalente_metros) FROM aprovechamiento_conteo AS c 
WHERE c.aprovechamiento_id = a.itemId)
AS equivalente_metros

FROM aprovechamiento AS a
LEFT JOIN empresa AS e ON e.itemId = a.empresa_id
";

        /**
         * Solo las fichas en estado 4 = verificadas y aprobadas
         */
        if ($item["tipo_institucion"]!=0 and $item["tipo_institucion"]!=""){
            $where= "WHERE e.tipo_institucion_id = '".$item["tipo_institucion"]."' ";
        }

        $sql .= $where;
        $item = $this->dbm->Execute($sql);
        $item = $item->getRows();
        return $item;
    }

    function fecha_convierte($fecha){
        $fecha = str_replace("/","-",$fecha);
        $fecha = $this->invertDate_sbm($fecha);
        return $fecha;
    }

}