<?php
/**
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:22
 */

class Subcatalogo extends Table{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();

    }
    
    public function obtCurtiembre(){
        $sql="SELECT rc.itemId,u.nombre,u.apellido,c.curtiembre 
        FROM responsable_curtiembre rc
        INNER JOIN curtiembre c on 
        c.itemId=rc.curtiembre_itemId
        INNER JOIN usuario_rol ur 
        on ur.itemId=rc.usuario_itemId
        INNER JOIN vrhr_snir.core_usuario u on
        ur.usuario_itemId=u.itemId";
        $res=$this->dbm->Execute($sql);
        $res=$res->GetRows();        
        $opt = array();
        foreach($res as $row){
                $opt[$row["itemId"]] = $row["nombre"]." ".$row["apellido"]." - ".$row["curtiembre"];
        }
		return $opt;
        
    }
    public function conf_catalog_datos_general(){



    }

}