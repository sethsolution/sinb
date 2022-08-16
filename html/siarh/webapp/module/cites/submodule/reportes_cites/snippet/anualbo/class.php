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
c.itemId
,c.estado_id
, e.nombre AS estado
,c.emitido_fecha
,year(c.emitido_fecha) AS anio
,ca.nombre AS apendice
,ces.nombre_comun AS nombre_comun
,ces.nombre AS nombre_cientifico
,ccc.nombre AS codigo_comercio

,ce.cantidad
,ctu.unidad

,cp1.sigla AS pais_importador
,cp2.sigla AS pais_exportador
,ce.numero_permiso AS numero_permiso_exportacion

, ctp.sigla AS proposito
, cto.sigla AS origen
, c.zoosanitario_emision 
, c.zoosanitario_numero
, ctd.nombre AS tipo_permiso
, c.tipo_documento_id
from cites_especie AS ce
LEFT JOIN cites AS c ON c.itemId = ce.cites_id
LEFT JOIN catalogo_especie AS ces ON ces.itemId = ce.especie_id
LEFT JOIN catalogo_apendice AS ca ON ca.itemId = ce.apendice_id
LEFT JOIN catalogo_tipo_unidad AS ctu ON ctu.itemId = ce.unidad_id
LEFT JOIN catalogo_codigo_comercio AS ccc on ccc.itemId = ce.codigo_comercio_id
LEFT JOIN catalogo_pais AS cp1 ON cp1.itemId = c.importacion_pais_id
LEFT JOIN catalogo_pais AS cp2 ON cp2.itemId = c.exportador_pais_id
LEFT JOIN catalogo_pais AS cp3 ON cp3.itemId = ce.pais_id
LEFT JOIN catalogo_tipo_origen AS cto ON cto.itemId= ce.origen_id
LEFT JOIN catalogo_tipo_proposito AS ctp ON ctp.itemId = c.proposito_id
LEFT JOIN catalogo_tipo_documento AS ctd ON ctd.itemId = c.tipo_documento_id
LEFT JOIN catalogo_estado AS e ON e.itemId = c.estado_id
";
        /**
         * Solo las fichas en estado 4 = verificadas y aprobadas
         */
        $where = "where c.estado_id = 4 ";

        if (is_array($item["especies"])){
            $dato = implode(',', $item["especies"]);
            $where .= " AND ces.itemId IN (".$dato.")";
        }


        $item["fecha_inicio"] = trim($item["fecha_inicio"]);
        $item["fecha_fin"] = trim($item["fecha_fin"]);
        if( $item["fecha_inicio"]!="" and $item["fecha_fin"]!="" ){
            $fecha_inicio = $this->fecha_convierte($item["fecha_inicio"]);
            $fecha_fin = $this->fecha_convierte($item["fecha_fin"]);
            $where .= " AND c.emitido_fecha BETWEEN '".$fecha_inicio."' and '".$fecha_fin."' ";
        }else if( $item["fecha_inicio"]!="" and $item["fecha_fin"]=="" ){
            $fecha_inicio = $this->fecha_convierte($item["fecha_inicio"]);
            $where .= " AND c.emitido_fecha >= '".$fecha_inicio."' ";
        }


        if (is_array($item["cites_tipo"])){
            $dato = implode(',', $item["cites_tipo"]);
            $where .= " AND c.tipo_id IN (".$dato.")";
        }

        if (is_array($item["tipo_documento"])){
            $dato = implode(',', $item["tipo_documento"]);
            $where .= " AND c.tipo_documento_id IN (".$dato.")";
        }

        if (is_array($item["pais_importacion"])){
            $dato = implode(',', $item["pais_importacion"]);
            $where .= " AND c.importacion_pais_id IN (".$dato.")";
        }

        if (is_array($item["pais_exportacion"])){
            $dato = implode(',', $item["pais_exportacion"]);
            $where .= " AND c.exportador_pais_id IN (".$dato.")";
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