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


    function get_data($anio){
        $sql = "SELECT sum(ep.monto) AS total
FROM empresa_pago AS ep
LEFT JOIN cites AS c ON c.itemId = ep.cites_id
WHERE ep.categoria_id=2 and year(ep.fecha_pago)='".$anio."' 
;";

        //print_struc($sql);
        $dato = $this->dbm->Execute($sql);
        $dato = $dato->fields;
        if($dato["total"]=="") $dato["total"] = 0;
        return $dato["total"];
    }

    function consulta($item){
        /**
         * Recoje los datos de meses y especies seleccionadas
         */

        $anios = array();
        for($i=$item["anio_inicio"];$i<=$item["anio_final"];$i++){
            $anios[]=$i;
        }
        $resultado = array();
        foreach ($anios as $idx => $row){
            $total = 0;
            $resultado[$idx]["anio"] = $row;
            $resultado[$idx]["total"] = $this->get_data($row);

        }
        //print_struc($resultado);
        $item["anios"] = $anios;
        $item["resultado"] = $resultado;
        return $item;
    }

    function fecha_convierte($fecha){
        $fecha = str_replace("/","-",$fecha);
        $fecha = $this->invertDate_sbm($fecha);
        return $fecha;
    }

}