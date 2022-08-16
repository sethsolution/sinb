<?php
class Snippet extends Table
{
    var $item_form;
    var $dbm_codice;
    function __construct()
    {
        global $dbm_codice;
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
        /**
         * Base de datos principal
         */
        $this->dbm_codice = $dbm_codice;

    }
    public function get_codice_resumen($id){

        $usuario_resumen = $this->get_resumen($id);
        //print_struc($usuario_resumen["codice_usuario"]);

        if(isset($usuario_resumen["codice_usuario"]["id"]) && $usuario_resumen["codice_usuario"]["id"]!=""){
            /**
             * Resumen de la cantidad
             */
            $sql ="SELECT e.id,e.estado, count(*) as cantidad
                  FROM ".$this->tabla["co_seguimiento"]." s 
                  left JOIN ".$this->tabla["co_estados"]." e ON s.estado=e.id 
                  where s.derivado_a = '".$usuario_resumen["codice_usuario"]["id"]."' AND s.estado<>'4'
                  GROUP BY s.estado ";
            $item = $this->dbm_codice->Execute($sql);
            $item = $item->getRows();

            $bandeja = array();
            foreach ($item as $row){
                $bandeja[$row["id"]]["estado"] = $row["estado"];
                $bandeja[$row["id"]]["cantidad"] = $row["cantidad"];
            }
            /**
             * Recumen de los documentos
             */
            $sql ="select t.id,t.tipo,t.plural,t.action,COUNT(*) as cantidad
                  from ".$this->tabla["co_documentos"]."  as d
                  left join ".$this->tabla["co_tipos"]." as t on t.id = d.id_tipo
                  where d.id_user = '".$usuario_resumen["codice_usuario"]["id"]."' GROUP BY d.id_tipo ";
            $documentos = $this->dbm_codice->Execute($sql);
            $documentos = $documentos->getRows();
            //print_struc($documentos);
            /**
             * Resumen de personas abajo
             */
            $sql = "select
                    (select COUNT(*) from ".$this->tabla["co_seguimiento"]." as s where s.derivado_a = u.id and s.estado = 2 ) as pendientes
                    ,u.*
                    from ".$this->tabla["co_users"]." as u
                    where  u.habilitado = 1 and u.superior = '".$usuario_resumen["codice_usuario"]["id"]."' ";
            $dependientes = $this->dbm_codice->Execute($sql);
            $dependientes = $dependientes->getRows();

        }

        $res["bandeja"] = $bandeja;
        $res["documentos"] = $documentos;
        $res["usuario"] = $usuario_resumen["codice_usuario"];
        $res["dependientes"] = $dependientes;


        return $res;
    }


    function get_item($id,$tabla,$id_name="itemId",$where=""){

        $sql = "select * from ".$tabla." as i where i.".$id_name." = '".$id."' ";
        if($where !=''){
            $sql .= " and ".$where;
        }
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

    public function get_resumen($id){
        /*
        if(isset($id) && $id!='')
            $persona = $this->get_item($id,$this->tabla["persona"]);
        */


        if(isset($id) && $id!='')
            $user_codice = $this->get_item($id,$this->tabla["persona_codice"],"persona_id"," activo=1 ");

        if(isset($user_codice["codice_id"]) && $user_codice["codice_id"]!='') {

            $sql = "select o.oficina,o.sigla as oficina_sigla,e.entidad,e.sigla as entidad_sigla,u.* 
                    from ". $this->tabla["co_users"]." as u
                    left join ". $this->tabla["co_oficinas"]." as o on o.id = u.id_oficina
                    left join entidades as e on e.id = o.id_entidad
                    where u.id='".$user_codice["codice_id"]."'";
            $item = $this->dbm_codice->Execute($sql);
            $codice_usuario = $item->fields;
            $codice_usuario["last_login"] = gmdate("Y-m-d H:i:s", $codice_usuario["last_login"]);
        }
        //$res["user"] = $user;
        //$res["persona"] = $persona;
        $res["codice_usuario"] = $codice_usuario;
        return $res;
    }

}