<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:23
 */

class Index extends Table {

    function __construct()
    {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    function get_menu_principal(){
        global $db,$usuarioInfo;

        //print_struc($usuarioInfo);exit;

        $sql = "select c.itemId,c.nombre,c.descripcion, c2.nombre as padre_nombre,c.padre ,c.class
                ,c2.admin,c2.privado
                ,c.admin as padre_admin,c.privado as padre_privado
                from ".$this->tabla_core["c_categoria"]." as c left join ".$this->tabla_core["c_categoria"]." as c2 on c2.itemId = c.padre 
                where c.activo=1 and c.padre is not NULL ";

        if($usuarioInfo){
            //echo "existe";
            if($usuarioInfo["tipoUsuario"] != 1){
                $sql .= " and c.admin = 0 and c2.admin = 0 ";
               // ECHO "ENTRO";EXIT;
            }
        }else{
            $sql .= " and c.admin = 0 and c.privado=0 and  c2.admin = 0 and c2.privado=0 ";
        }
        $sql .= " order by c2.orden, c.orden";


        $item = $db->Execute($sql);
        $item = $item->getRows();
        for ($i=0;$i<count($item);$i++){

            $sql2 = "select 
             mo.carpeta 
            , sub.carpeta as submodulo
            , mo2.carpeta as modulo
            , m.*
            from ".$this->tabla_core["menu"]." as m 
            left join ".$this->tabla_core["modulo"]." as mo on mo.itemId = m.modulo_id
            left join ".$this->tabla_core["submodulo"]." as sub on sub.itemId = m.submodulo_id
            left join ".$this->tabla_core["modulo"]." as mo2 on mo2.itemId= sub.moduloId
            where m.activo=1 and m.categoria_id = '".$item[$i]["itemId"]."' order by m.orden";

            $submenu = $db->Execute($sql2);
            $submenu = $submenu->getRows();
            $item[$i]["submenu"] = $submenu;
        }
        //print_struc($item);exit;
        return $item;

    }

    function get_item($idItem,$tipoTabla,$variante=""){
        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = '';
        if($idItem!=''){
            if($tipoTabla=='persona'){
                $sqlSelect = ' i.*
                           , CONCAT_WS(" ",u1.nombre,u1.apellido) as userCreater
                           , CONCAT_WS(" ",u2.nombre,u2.apellido) as userUpdater';
                $sqlFrom = ' '.$this->tabla[$tipoTabla].' i
                         LEFT JOIN '.$this->tabla["o_usuario"].' u1 on u1.itemId=i.userCreate
                         LEFT JOIN '.$this->tabla["o_usuario"].' u2 on u2.itemId=i.userUpdate';
                $sqlWhere = ' i.itemId='.$idItem;
                $sqlGroup = ' GROUP BY i.itemId';
            }else{
                $sqlSelect = ' i.*';
                $sqlFrom = ' '.$this->tabla[$tipoTabla].' i ';
                $sqlWhere = ' i.itemId='.$idItem;
            }

            $sql = 'SELECT '.$sqlSelect.'
                  FROM '.$sqlFrom.'
                  WHERE '.$sqlWhere.'
                  '.$sqlGroup;
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        return $info;
    }


    public function getPhoto($type){
        global $CFGm;

        /**
         * Verificamos y/o Creamos la carpeta de perfiles
         */
        $CFGm->carpeta_modulo = "perfil";
        $CFGm->directory = $CFGm->directory_padre.$CFGm->carpeta_modulo."/";
        $CFGm->directory = $CFGm->carpeta_padre."/".$CFGm->carpeta_modulo."/";


        //$core->directorio_crear($CFGm->directory);

        $itemId = $this->userv["itemId"];
        $dirAttached = $CFGm->directory.$itemId."/";
        $conten_Disposition = "inline";



        if($type==0){
            $file = $dirAttached."small/".$itemId.".jpg";
            /*}elseif($type==1){*/
        }else{
            $file = $dirAttached."thumbails/b_".$itemId.".jpg";
        }



        if(file_exists($file)){
            $type = "image/jpeg";
            $ext = "jpg";
        }else{
            $type = "image/png";
            $file = "./images/core/perfil/user1.png";
            $ext = "png";
        }



        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-Type: $type");
        header ('Content-Disposition: '.$conten_Disposition.'; filename="perfil.'.$ext.'"');
        //header ("Content-Length: ".$item["photoSize"]);
        readfile($file);
        exit;
    }
}