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
    public function guardarDatosLongitud($data,$id,$type){
                $sql="Insert into acta_cuero_longitud(itemId,longitud_cuero_itemId,cantidad,primera,segunda,rechazados,pie_cuadrado,precio_unidad,precio_total,acta_cuero_itemId)
            values (?,1,1,?,?,?,?,?,?,1)
            ON DUPLICATE KEY UPDATE
            itemId=VALUES(itemId),
            primera=VALUES(primera),
            segunda=VALUES(segunda),
            rechazados=VALUES(rechazados),
            pie_cuadrado=VALUES(pie_cuadrado),
            precio_unidad=VALUES(precio_unidad),
            precio_total=VALUES(precio_total);";
            $this->dbm->bulkBind = true;
            $res=$this->dbm->Execute($sql,$data);
            if($res){
                return true;
            }
            else{
                return false;

            }
        
    }
    function obtenerRepresentante(){
        try{
            $sql="Select rc.itemId
            FROM representante_legal rc
            INNER JOIN usuario_rol ur on ur.itemId=rc.usuario_itemId
            INNER JOIN vrhr_snir.core_usuario usuario on usuario.itemId= ur.usuario_itemId
            WHERE usuario.itemId=".$_SESSION["memberId"];
            /*
* Enable bulk binding
*/
            $res=$this->dbm->Execute($sql);
            $res=$res->GetRows();
            if($res){
             return $res[0];
            }
            else{
                return false;
            }

        }
        catch( Exception $e){
            return false;
            
        }
    }
    function item_update($rec,$itemId,$que_form,$accion){
        if($this->verificarTiempoResolucion(3)){
            $prev="";
            if(isset($_POST["prev"])){
                $rec["estado"]="2";
                $prev="yes";
            }
            else{            
                $rec["estado"]="1";
                $rec["fecha_acta"]=date("Y-m-d");
            }
            $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion);
            $filas=json_decode($_POST["filas"]);
            $campo_id="itemId";
            $where="estado=2 and gestion_itemId=".date("Y");
            $ver=$this->verificar_permiso_usuarios(["4"]); 
            if($ver)
            {
                $this->dbm->transOff = 0;
                $this->dbm->BeginTrans();
                $res = $this->item_update_sbm($itemId,$respuesta_procesa,$que_form,$accion,$campo_id,$where); 
		$affected=$this->dbm->affected_rows();
                $longRes=$this->guardarDatosLongitud($filas,$res["id"],$accion);
                if($longRes&&$res["res"]!=2&&$affected){
                    $res["atras"] = "se hizo commit";
                    $this->dbm->commitTrans();
                }
                else{
                	$res["res"] = 2;
                    $res["atras"] = "se hizo atras";
                    $res["mal"]=$this->dbm->ErrorMsg();
                    $this->dbm->RollbackTrans();
                }
            }
            else{
                
                $res["res"] = 2;
                $res["msg"] = "No se logro actualizar la informacion en la B.D.";
                $res["msgdb"] = $this->dbm->ErrorMsg();
            }
            $res["accion"] = $accion;
            $res["prev"]=$prev;
        
        }
        else{

            $res["res"] = 2;
            $res["msg"] = "No esta habilitado para realizar reportes en esta fecha.";
            $res["msgdb"] = "";
        }

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
}