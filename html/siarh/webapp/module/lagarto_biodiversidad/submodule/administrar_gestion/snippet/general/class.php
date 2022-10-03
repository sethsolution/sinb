<?php
class Snippet extends Table
{
    var $item_form;
    function __construct()
    {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();

    }
    /**
     * Function que actualiza la informacion de datos de un registro
     * $respuesta = $subObjItem->item_update($item,$itemId,0);
     * $rec = arreglo de datos que llega del formulario
     * $itemId= el id del reguistro que quiero actualizar
     * $que_form = El formulario dentro que quiero actualizar, "Es el mismo nombre del grupo de campos que quiero validar"
     * $accion = new, update ,  solo existen 2 acciones
     *
     **/
    function obtenerTCO($gestion=1,$municipioId=1,$type){
        echo "<script>console.log('".$gestion."')</script>";
            $sql="SELECT tco.itemId,tco.tco
            FROM tco";
            if($type=="new"){
                $sql.=" left outer join gestion_tco on 
                tco.itemId = gestion_tco.tco_itemId
                WHERE
                (gestion_tco.tco_itemId is null or gestion_tco.gestion_itemId!=".$gestion.") and
                tco.municipio_itemId=".$municipioId;
            }
            $res=$this->dbm->Execute($sql);
            if($res){
                $res=$res->GetRows();        
                $opt = array();
                foreach($res as $row){
                        $opt[$row["itemId"]] = $row["tco"];
                }
            }
            else{
                $opt=[];
            }
            return $opt;
            
        }
    function item_new_gestion($rec){
        $sql="INSERT INTO gestion (itemId,dateCreate,dateUpdate,userCreate,userUpdate,ini_rueda_negocios,fin_rueda_negocios,ini_caza,fin_caza,ini_movilizacion,fin_movilizacion)
        VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $res=$this->dbm->Execute($sql,[date("Y"),$rec["dateCreate"],$rec["dateUpdate"],$rec["userCreate"],$rec["userUpdate"],$rec["ini_rueda_negocios"],$rec["fin_rueda_negocios"],$rec["ini_caza"],$rec["fin_caza"],$rec["ini_movilizacion"],$rec["fin_movilizacion"]]);
        if($res){
            return true; 
        }
        else{
            return false;
        }
    }
    function guardarArchivoAdjunto($archivo){
        $dir = $this->get_dir_item_archivo_sbm("pdf",1,"resoluciones");
        $id = uniqid();
        $adjunto_local = $dir.$id.".pdf";
        if(copy($archivo["tmp_name"],$adjunto_local)){
            return $id;
        }
        else{
            return false;
        }
    }
    function get_file($id,$item_id){
        $item = $this->get_item($id,$item_id);
        if($item["itemId"]!=""){
            $dir  = $this->get_dir_item_archivo_sbm($item_id,"resoluciones");
            $archivo = $dir.$id.".".$item["adjunto_extension"];
            header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-Type:".$item["adjunto_tipo"]);
            header ('Content-Disposition: attachment; filename="'.$item["adjunto_nombre"].'"');
            header ("Content-Length: " . $item["adjunto_tamano"]);
            readfile($archivo);
            exit;
        }else{
            echo "<center><b><font color='red' face='arial'>El Archivo No existe</font></b></center>";
        }
        exit;
    }
    function item_update($rec,$itemId,$que_form,$accion,$input_archivo){
        /**
         * preprocesamos los datos
         */
        $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion);
        /**
         * Guardo los datos ya procesados
         */
        $campo_id="itemId";
        $where="";
        $ver=$this->verificar_permiso_usuarios(["1"]);
        if($ver){
            if($accion=="new"){

                if($this->item_new_gestion($respuesta_procesa)){
                    $res["res"] = 1;
                    $res["msg"] = "Datos ingresados correctamente";
                    $res["id"] = date("Y");
                }
                else{
                    $res["res"] = 2;
                    $res["msg"] = "No se logro crear la Gestion.";
                    $res["msgdb"] = $this->dbm->ErrorMsg(); 
                }
            }
            else{
                $res = $this->item_update_sbm($itemId,$respuesta_procesa,"gestion",$accion,$campo_id,$where);
            }

        }
        else{
            
            $res["res"] = 2;
            $res["msg"] = "No se logro actualizar la informacion en la B.D.";
            $res["msgdb"] = $this->dbm->ErrorMsg();
        }
        $res["accion"] = $accion;

        return $res;
    }
    /**
     * Funcion que valida los campos a ser guardados
     **/
    function procesa_datos($que_form,$rec,$accion="new"){
        $dato_resultado = array();
        $dato_resultado = $this->procesa_campos_sbm($rec,$this->campos[$que_form],$accion);
        return $dato_resultado;
    }
    
    /**
	 * Table::subirFotoServidor()
	 * 
	 * @param mixed $rol_Id
	 * @return boolean
	 */
    
}