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

    public function getMenuTop(){
        global $db;
        /**
         * Usuario Administrador y Root
         */
        if($this->userv["tipoUsuario"]==0 || $this->userv["tipoUsuario"]==1){
            $sql="select * from ".$this->tabla_core["modulo"]." as m 
                    where m.activo = 1 order by m.orden";
        }
        /**
         * Usuario Normal
         */
        else{
            $sql="select * from ".$this->tabla_core["modulo"]." where itemId in(
                select moduloId from ".$this->tabla_core["submodulo"]." as sb
                where sb.itemId in (
                    select subModuloId from ".$this->tabla_core["usuario_permisos"]." as p
                    where usuarioId='".$this->userv["itemId"]."'
                )
                and parent = 0 and activo = 1) 
                and activo = 1 order by orden";
        }

        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $info= $db->Execute($sql);
        $num = $info->RecordCount();
        $menu = $info->GetRows();
        return $menu;
    }

    public function getMenuIzquierdo($moduloid){
        global $db;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);

        /**
         * Usuario Root y Administradores
         */

        //print_struc($this->userv["itemId"]);
        //exit;

        if($this->userv["tipoUsuario"]==0 || $this->userv["tipoUsuario"]==1){
            $sql = "select s.nombre, s.itemId, s.descripcion, s.ventana 
				from ".$this->tabla_core["submodulo"]." as s where 
				s.moduloId = ".$moduloid." 
				and s.parent = 0 and s.activo=1
				order by s.orden asc";
            /**
             * Usuarios normales con permisos asignados
             */
        }else{
            $sql = "select s.nombre, s.itemId, s.descripcion 
                from 
                ".$this->tabla_core["usuario_permisos"]." as p,
                ".$this->tabla_core["submodulo"]." as s 
                where p.usuarioId='".$this->userv["itemId"]."'
                and s.itemId = p.subModuloId 
                and s.activo = 1
                and s.moduloId = ".$moduloid."
                and s.parent = 0 
                order by s.orden asc";
        }
        $info= $db->Execute($sql);
        $num = $info->RecordCount();
        $titulo = $info->GetRows();
        $menu = array();
        //print_struc($titulo);


        for ($i=0;$i<count($titulo);$i++){
            $menu[$i] = $titulo[$i];
            /**
             * Usuario Root y Administradores
             */
            if($this->userv["tipoUsuario"]==0 || $this->userv["tipoUsuario"]==1){
                $sql = "select s.* , m.carpeta as carpetaModulo
					from ".$this->tabla_core["submodulo"]." as s, 
                    ".$this->tabla_core["modulo"]." as m 
					where 
                    m.itemId=s.moduloId 
					and s.parent = ".$titulo[$i]["itemId"]." 
					and s.activo=1
                    order by s.orden asc";
            }else{
                $sql = "select s.* , m.carpeta as carpetaModulo
                    from ".$this->tabla_core["usuario_permisos"]." as p,
				    ".$this->tabla_core["submodulo"]." as s, 
                    ".$this->tabla_core["modulo"]." as m
				    where 
                    p.usuarioId='".$this->userv["itemId"]."'
				    and m.itemId = s.moduloId
				    and s.itemId = p.subModuloId 
                    and s.activo = 1
				    and s.parent = ".$titulo[$i]["itemId"]."
                    order by s.orden asc
                    ";
            }
            //echo $sql;
            $info= $db->Execute($sql);
            $menu[$i]["subModule"] = $info->GetRows();
        }

        return $menu;
    }
}