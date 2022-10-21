<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 17/06/2020
 * Time: 19:14
 */

class Index extends Table {

    function __construct()
    {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    public function verifica($code){
        global $objCatalog;
        $code = unserialize(base64_decode($code));

        $bindVars = array($code["id"],$code["code"]);
        $sql = "SELECT 
       e.nombre as estado
       ,c.* FROM ".$this->tabla["cites"]." AS c 
        left join ".$this->tabla["c_estado"]." as e on e.itemId= c.estado_id
        WHERE c.itemId=? AND c.code=?
        
        ";
        $item = $this->dbm->execute($sql,$bindVars);
        $item = $item->fields;
        if (isset($item["itemId"]) && $item["itemId"]!="" ){
            $item_id = $item["itemId"];
        }
        return $item;
    }

    /**
     * Get especies para la previsualizacion
     */
    function get_especie_list($item_id){
        $sql = "select CONCAT(e.nombre_comun,' - ',e.nombre) as nombre_especie, e.nombre_comun, e.nombre,
        p.descripcion, a.nombre as apendice, CONCAT(p.cantidad,'  ',u.unidad) as unidad, p1.nombre AS pais
        , o.sigla as origen, p.numero_permiso, p.cupo_solicitado, p.cupo_total
        from ".$this->tabla["especie"]." as p 
        LEFT JOIN ".$this->tabla["c_especie"]." AS e ON e.itemId = p.especie_id
        LEFT JOIN ".$this->tabla["c_apendice"]."  AS a ON a.itemId = p.apendice_id
        LEFT JOIN ".$this->tabla["c_tipo_unidad"]."  AS u ON u.itemId = p.unidad_id
        LEFT JOIN ".$this->tabla["c_pais"]."  AS p1 ON p1.itemId = p.pais_id
        LEFT JOIN ".$this->tabla["c_tipo_origen"]."  AS o ON o.itemId = p.origen_id
        where p.empresa_id = '" . $this->empresa_id. "' and cites_id='".$item_id."'";
        print_struc($sql);
        //print_struc($sql);
        $info = $this->dbm->execute($sql);
        $item = $info->getRows();
        return $item;
    }


}