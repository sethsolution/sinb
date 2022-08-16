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

if(c.estado_id IS NULL,d.estado_id,c.estado_id) AS estado_id

,cc.nombre AS categoria
, ep.categoria_id
, cepe.nombre AS estado
, ep.estado_id

, c.numero AS numero_certificado
, c.emitido_fecha 
,year(c.emitido_fecha) AS anio
,e.nombre AS nombre_exportador
, ep.monto 
, ep.fecha_pago
, ep.numero_boleta
, ep.observacion


FROM
empresa_pago AS ep
LEFT JOIN catalogo_categoria AS cc ON cc.itemId = ep.categoria_id
LEFT JOIN catalogo_empresa_pago_estado AS cepe ON cepe.itemId = ep.estado_id
LEFT JOIN cites AS c ON c.itemId = ep.cites_id
LEFT JOIN dispensacion AS d ON d.itemId = ep.dispensacion_id
LEFT JOIN empresa AS e ON e.itemId = ep.empresa_id
";
        //print_struc($item); exit;
        /**
         * Solo las fichas en estado 4 = verificadas y aprobadas
         */
        $where= "WHERE (if(c.estado_id IS NULL,d.estado_id,c.estado_id) = 4)";

        if( $item["fecha_inicio"]!="" and $item["fecha_fin"]!="" ){
            $fecha_inicio = $this->fecha_convierte($item["fecha_inicio"]);
            $fecha_fin = $this->fecha_convierte($item["fecha_fin"]);
            if ($item["categoria"] != '0'){
                if($item["categoria"] == 2){
                    $where .= " AND c.emitido_fecha BETWEEN '".$fecha_inicio."' and '".$fecha_fin."'";
                }
                else{
                    $where .= " AND d.emitido_fecha BETWEEN '".$fecha_inicio."' and '".$fecha_fin."'";
                }
            }else{
                $where .= " AND (c.emitido_fecha BETWEEN '".$fecha_inicio."' and '".$fecha_fin."' OR d.emitido_fecha BETWEEN '".$fecha_inicio."' and '".$fecha_fin."') ";
            }
            //
        }

        if ($item["categoria"] != '0'){
            if($item["categoria"] == 2){
                $where .= " AND ep.categoria_id IN (2,6)";
            }
            else{
                $where .= " AND ep.categoria_id IN (3,7)";
            }
        }else{
            $where .= " AND ep.categoria_id IN (2,6,3,7)";
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