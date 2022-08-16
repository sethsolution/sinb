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

    function get_resumen01($idItem){
        $item = $this->get_item_destalle($idItem);
        $item["edad"] = new DateTime($item["fecha_nacimiento"]);
        $hoy = new DateTime();
        $item["edad"] = $hoy->diff($item["edad"]);
        $item["edad"] = $item["edad"]->y;
        return $item;
    }

    function get_item_destalle($idItem){
        $sql ="select  d.nombre as ci_expedido ,p.* 
              from ".$this->tabla["persona"]." as p
              left join ".$this->tabla["o_departamento"]." as d on d.itemId=p.ci_exp
              where p.itemId = '".$idItem."' ";

        $info = $this->dbm->Execute($sql);
        $info = $info->fields;
        return $info;


    }

    function get_item($idItem,$tipoTabla,$variante=""){

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


    public function get_item_datatable_Rows(){
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["persona"];
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = 'itemId';
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "index";
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
        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */
        return $resultado;

    }

    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id){
        $campo_id="itemId";
        $res = $this->item_delete_sbm($id,$campo_id,$this->tabla["persona"]);
        return $res;
    }

    function item_update_avatar($rec,$itemId,$que_form,$input_archivo){
        $tabla = $this->tabla["persona"];
        $accion = "update";
        $item_id = "";
        /**
         * Procesamos la imagen primero
         */
        $item = $this->get_item($itemId,"persona");
        $imagen = $this->item_imagen_sbm($input_archivo,$item_id,$itemId,$item,$tabla,$accion,"","avatar");

        if($imagen["res"]==1){
            $res = $imagen;
        }else{
            $res["res"] = 2;
            $res["msg"] = "No se adjunto ningun archivo, no se guardo el archivo físicamente";
        }
        return $res;
    }

    public function get_foto($id,$tipo){

        $dir = $this->get_dir_item_archivo_sbm($id,1,"avatar");
        $imagen = $id.".jpg";

        $thumbnail= "thumbnail/";
        $file = $dir.$thumbnail.$tipo."_".$imagen;

        $conten_Disposition = "inline";
        //$conten_Disposition = "attachment";

        if(file_exists($file)){
            $type = "image/jpeg";
            $ext = "jpg";
        }else{
            $type = "image/png";
            $file = "./images/core/perfil/user.png";
            $ext = "png";
        }
        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-Type: $type");
        header ('Content-Disposition: '.$conten_Disposition.'; filename="perfil-'.$id.'.'.$ext.'"');
        readfile($file);
        exit;
    }

    public function get_foto_download($id){
        $item = $this->get_item($id,"persona");

        $dir = $this->get_dir_item_archivo_sbm($id,1,"avatar");
        $imagen = $id.".jpg";
        $file = $dir.$imagen;
        //echo $file;exit;
        if(file_exists($file)){
            $type = "image/jpeg";
            $ext = "jpg";
            $filename = $item["adjunto_nombre"];
        }else{
            $type = "image/png";
            $file = "./images/core/perfil/user.png";
            $ext = "png";
            $filename = "perfil-'.$id.'.'.$ext.'";
        }
        //$filename = "perfil-".$id.".".$ext;
        $conten_Disposition = "attachment";
        //$conten_Disposition = "inline";

        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-Type: $type");
        header ('Content-Disposition: '.$conten_Disposition.'; filename="'.$filename.'"');
        readfile($file);
        exit;
    }

}