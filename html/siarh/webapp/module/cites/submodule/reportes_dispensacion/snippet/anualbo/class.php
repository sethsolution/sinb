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

        //print_struc($item);

        $sql = "
SELECT 
d.itemId
, d.estado_id
, e.nombre AS estado
,d.emitido_fecha
,year(d.emitido_fecha) AS anio
,ces.nombre_comun AS nombre_comun
,ces.nombre AS nombre_cientifico
,ce.cantidad
,ctu.unidad
,cp1.sigla AS pais_importador
,cp2.sigla AS pais_exportador
, ctp.sigla AS proposito
, d.zoosanitario_origen_emision 
, d.zoosanitario_origen_numero
,d.zoosanitario_destino_emision
, d.zoosanitario_destino_numero
, ctd.nombre AS tipo_permiso
, d.tipo_documento_id

from dispensacion_especie AS ce
LEFT JOIN dispensacion AS d ON d.itemId = ce.dispensacion_id
LEFT JOIN catalogo_especie AS ces ON ces.itemId = ce.especie_id
LEFT JOIN catalogo_tipo_unidad AS ctu ON ctu.itemId = ce.unidad_id
LEFT JOIN catalogo_pais AS cp1 ON cp1.itemId = d.importacion_pais_id
LEFT JOIN catalogo_pais AS cp2 ON cp2.itemId = d.importacion_pais_id
LEFT JOIN catalogo_tipo_proposito AS ctp ON ctp.itemId = d.proposito_id
LEFT JOIN catalogo_estado AS e ON e.itemId = d.estado_id
LEFT JOIN catalogo_tipo_documento AS ctd ON ctd.itemId = d.tipo_documento_id


";

        /**
         * Solo las fichas en estado 4 = verificadas y aprobadas
         */
        $where = "where d.estado_id = 4 ";

        if (is_array($item["especies"])){
            $dato = implode(',', $item["especies"]);
            $where .= " AND ces.itemId IN (".$dato.")";
        }

        $item["fecha_inicio"] = trim($item["fecha_inicio"]);
        $item["fecha_fin"] = trim($item["fecha_fin"]);
        if( $item["fecha_inicio"]!="" and $item["fecha_fin"]!="" ){
            $fecha_inicio = $this->fecha_convierte($item["fecha_inicio"]);
            $fecha_fin = $this->fecha_convierte($item["fecha_fin"]);
            $where .= " AND d.emitido_fecha BETWEEN '".$fecha_inicio."' and '".$fecha_fin."' ";
        }else if( $item["fecha_inicio"]!="" and $item["fecha_fin"]=="" ){
            $fecha_inicio = $this->fecha_convierte($item["fecha_inicio"]);
            $where .= " AND d.emitido_fecha >= '".$fecha_inicio."' ";
        }


        if (is_array($item["dispensacion_tipo"])){
            $dato = implode(',', $item["dispensacion_tipo"]);
            $where .= " AND d.dispensacion_id IN (".$dato.")";
        }

        if (is_array($item["tipo_documento"])){
            $dato = implode(',', $item["tipo_documento"]);
            $where .= " AND d.tipo_documento_id IN (".$dato.")";
        }

        if (is_array($item["pais_importacion"])){
            $dato = implode(',', $item["pais_importacion"]);
            $where .= " AND d.importacion_pais_id IN (".$dato.")";
        }

        if (is_array($item["pais_exportacion"])){
            $dato = implode(',', $item["pais_exportacion"]);
            $where .= " AND d.exportador_pais_id IN (".$dato.")";
        }

        $sql .= $where;

        //$this->dbm->debug = true;
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