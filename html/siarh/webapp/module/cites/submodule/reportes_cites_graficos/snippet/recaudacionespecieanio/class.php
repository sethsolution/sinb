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






    function get_especies($especie){
        $sql = "SELECT ce.itemId, ce.nombre, ce.nombre_comun, ce.descripcion, ce.activo, ce.apendice_id, ce.tipo
            FROM catalogo_especie AS ce WHERE ce.itemId IN (".$especie.") and tipo=1 order by ce.nombre_comun ";
        $dato = $this->dbm->Execute($sql);
        $dato = $dato->getRows();
        return $dato;
    }

    function get_especie_data($anio,$especie){
        $sql = "SELECT sum(ep.monto) AS total
FROM empresa_pago AS ep
LEFT JOIN cites AS c ON c.itemId = ep.cites_id
WHERE ep.categoria_id=2 and year(ep.fecha_pago)='".$anio."' 
AND c.itemId IN (SELECT ce.cites_id FROM cites_especie AS ce WHERE ce.especie_id ='".$especie."' GROUP BY ce.cites_id)
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

        $especie_where = implode(',',$item["especies"]);
        $especies = $this->get_especies($especie_where);


        $resultado = array();

        foreach ($anios as $idx => $row){
            $total = 0;
            $resultado[$idx]["anio"] = $row;
            foreach ($especies as $esp){
                $resultado[$idx][$esp["itemId"]] = $this->get_especie_data($row,$esp["itemId"]);
                $total = $total+$resultado[$idx][$esp["itemId"]];
            }
            $resultado[$idx]["total"] = round($total,0);
        }

        //print_struc($resultado);


        $item["especies"] = $especies;
        $item["anios"] = $anios;
        $item["resultado"] = $resultado;

        //print_struc($item["resultado"]);

        /* /
        print_struc($resultado);
        exit;
        /**/

        return $item;
    }

    function fecha_convierte($fecha){
        $fecha = str_replace("/","-",$fecha);
        $fecha = $this->invertDate_sbm($fecha);
        return $fecha;
    }

}