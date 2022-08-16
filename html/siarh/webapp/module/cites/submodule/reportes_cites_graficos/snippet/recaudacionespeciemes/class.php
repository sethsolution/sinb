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


    function get_mes(){
        $mes = array();
        $mes[] = array("id"=>1,"nombre"=>"Enero");
        $mes[] = array("id"=>2,"nombre"=>"Febrero");
        $mes[] = array("id"=>3,"nombre"=>"Marzo");
        $mes[] = array("id"=>4,"nombre"=>"Abril");
        $mes[] = array("id"=>5,"nombre"=>"Mayo");
        $mes[] = array("id"=>6,"nombre"=>"Junio");
        $mes[] = array("id"=>7,"nombre"=>"Julio");
        $mes[] = array("id"=>8,"nombre"=>"Agosto");
        $mes[] = array("id"=>9,"nombre"=>"Septiembre");
        $mes[] = array("id"=>10,"nombre"=>"Octubre");
        $mes[] = array("id"=>11,"nombre"=>"Noviembre");
        $mes[] = array("id"=>12,"nombre"=>"Diciembre");
        return $mes;
    }
    function get_especies($especie){
        $sql = "SELECT ce.itemId, ce.nombre, ce.nombre_comun, ce.descripcion, ce.activo, ce.apendice_id, ce.tipo
            FROM catalogo_especie AS ce WHERE ce.itemId IN (".$especie.") and tipo=1 order by ce.nombre_comun ";
        $dato = $this->dbm->Execute($sql);
        $dato = $dato->getRows();
        return $dato;
    }

    function get_especie_data($anio,$mes,$especie){
        $sql = "SELECT sum(ep.monto) AS total
FROM empresa_pago AS ep
LEFT JOIN cites AS c ON c.itemId = ep.cites_id
WHERE ep.categoria_id=2 and year(ep.fecha_pago)='".$anio."' AND MONTH(ep.fecha_pago)='".$mes."'
AND c.itemId IN (SELECT ce.cites_id FROM cites_especie AS ce WHERE ce.especie_id ='".$especie."' GROUP BY ce.cites_id)
;";

        $dato = $this->dbm->Execute($sql);
        $dato = $dato->fields;
        if($dato["total"]=="") $dato["total"] = 0;
        //print_struc($sql);exit;
        return $dato["total"];
    }

    function consulta($item){
        /**
         * Recoje los datos de meses y especies seleccionadas
         */
        $meses = $this->get_mes();
        $especie_where = implode(',',$item["especies"]);
        $especies = $this->get_especies($especie_where);
        //print_struc($especie_where);

        $resultado = array();

        foreach ($meses as $row){

            $total = 0;
            $resultado[$row["id"]]["anio"] = $item["anio"];
            $resultado[$row["id"]]["mes"] = $row["nombre"];
            foreach ($especies as $esp){
                //$resultado[$row["id"]][$esp["itemId"]] = $esp["nombre_comun"];
                $resultado[$row["id"]][$esp["itemId"]] = $this->get_especie_data($item["anio"],$row["id"],$esp["itemId"]);
                $total = $total+$resultado[$row["id"]][$esp["itemId"]];
            }
            $resultado[$row["id"]]["total"] = round($total,2);
        }

        $item["especies"] = $especies;
        $item["meses"] = $meses;
        $item["resultado"] = $resultado;

        //print_struc($item["resultado"]);

        /*
        print_struc($item);
        exit;
        */

        return $item;
    }

    function fecha_convierte($fecha){
        $fecha = str_replace("/","-",$fecha);
        $fecha = $this->invertDate_sbm($fecha);
        return $fecha;
    }

}