<?php

/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:23
 */

class Modulo_Core extends Table {

    function __construct(){
        global $CFG;
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();

            $this->tabla = $CFG->tabla;

    }

    function get_empresa_data(){
        global $db,$CFG;

        $this->dbm->debug = true;
        $sql = "SELECT cet.parent as tipo ,e.* FROM ".$CFG->tabla["cites_empresa"]." AS e 
         left join ".$CFG->prefix."cites.catalogo_empresa_tipo as cet on cet.itemId = e.tipo_id
         WHERE e.usuario_id='".$_SESSION["userv"]["itemId"]."'
         ";
        //print_struc($sql);
        $item = $db->execute($sql);
        $item = $item->fields;
        return $item;

    }
    function get_module_menu($id,$modulos_ids){
        global $db;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        /*
         * Sacamos datos del modulo
         */
        $sql = "select * from ".$this->tabla["submodulo"]." as sm where 
        sm.moduloId = '".$id."' and sm.parent=0 and sm.principal=0 and sm.activo=1 
        and sm.itemId in (".$modulos_ids.")
        order by sm.orden";
        $modulo =  $db->Execute($sql);
        $modulo = $modulo->getRows();

        $menu = array();
        foreach ($modulo as $row){

            $sql = "select 
                    (SELECT up.subModuloId FROM ".$this->tabla["usuario_permisos"]." AS up WHERE up.usuarioId='".$_SESSION["userv"]["itemId"]."' 
                    AND up.subModuloId = sm.itemId) AS ver,
                    m.carpeta as modulo_id_tipo_carpeta
                    , sb.carpeta as submodulo_id_carpeta
                    , m2.carpeta as submodulo_id_carpeta_padre
                    ,sm.*
                    
                    from ".$this->tabla["submodulo"]." as sm 
                    
                    left join ".$this->tabla["modulo"]."  as m on m.itemId = sm.modulo_id_tipo
                    left join ".$this->tabla["submodulo"]."  as sb on sb.itemId = sm.submodulo_id
                    left join ".$this->tabla["modulo"]." as m2 on m2.itemId = sb.moduloId 
                    
                    where sm.moduloId = '".$id."' 
                    and sm.parent='".$row["itemId"]."' 
                    and sm.principal=0 and sm.activo=1 
                    and sm.itemId in (".$modulos_ids.")
                    order by sm.orden";

            $child =  $db->Execute($sql);
            $child = $child->getRows();

            $row["submenu"] = $child;

            if(count($child)>0){
                $menu[]=$row;
            }
        }

        return($menu);

    }

    function getSModulePrivileges($module,$smodule,$modulos_ids){
        global $_SESSION,$db;
        $res["res"] = 0;
        /**
         * Sacamos los datos de la base de datos
         */
        $sql = "select u.* from usuario as u
                where u.itemId='".$_SESSION["userv"]["itemId"]."' ";

        $info = $db->Execute($sql);
        $item = $info->fields;
        $_SESSION["userv"] = $item;

        if( $_SESSION["userv"]["tipoUsuario"] == 0 || $_SESSION["userv"]["tipoUsuario"] == 1){
            $res["res"] = 1;
            $res["admin"] = 1;
        }else{
            $res = $this->getSModulePrivilegesUser($module,$smodule,$modulos_ids);
            $res["admin"] = 0;
        }
        $res["userId"]= $_SESSION["userv"]["itemId"];

        return $res;

    }

    function getSModulePrivilegesUser($module,$smodule,$modulos_ids){
        global $core,$_SESSION;
        $moduleData = $this->getModuleId($module);

        if ($moduleData["itemId"]==''){
            $moduleId = 0;
        }else{
            $moduleId = $moduleData["itemId"];
        }
        $smoduleData = $this->getSmoduleId($smodule,$moduleId,$modulos_ids);

        $resp = array();
        if (isset($smoduleData['priv'] )){
            $res = 1;
        }else{
            $res = 0;
        }
        $resp["res"] = $res;
        return $resp;
    }


    function getModuleId($module){
        global $db;
        $sql = "select * from ".$this->tabla["modulo"]." where carpeta = '".$module."'";
        $item = $db->Execute($sql);
        return $item->fields;
    }

    function getSmoduleId($smodule,$id,$modulos_ids){
        global $db,$_SESSION;
        $sql = "select 
                ifnull(
                    (
                    select  up.subModuloId from ".$this->tabla["usuario_permisos"]." as up 
                    where up.subModuloId = sm.itemId 
                    and up.usuarioId=".$_SESSION["userv"]["itemId"]."
                    )
                    ,0
                ) as priv,sm.*
                
                from ".$this->tabla["submodulo"]." as sm 
                where
                sm.itemId in (".$modulos_ids.") 
                and sm.carpeta='".$smodule."'  
                and sm.parent!=0  
                and activo=1 
                and sm.moduloId=".$id;
        $item = $db->Execute($sql);
        return $item->fields;
    }
}