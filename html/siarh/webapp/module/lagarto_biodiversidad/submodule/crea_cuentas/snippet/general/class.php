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
    function usuario_menu_save($rol,$id_usuario){
        if($rol!=2){
            $admin_dir=array("crea_cuentas","acta_proc_carne_2","acta_proc_cuero_2","acta_ten_cuero","administrar_cupos","administrar_gestion","caza","curt_cust_cuero","gestionar_curt","gestionar_tco","tco_cust_carne","tco_cust_cuero_actas");
            $regional_dir=array("acta_proc_carne_1","acta_proc_cuero_1","administrar_cupos","caza","curt_cust_cuero","tco_cust_carne","tco_cust_cuero_actas");
            $empresa_dir=array("acta_proc_carne_2","acta_proc_cuero_2","acta_ten_cuero");
            $tecnico_dir=array("acta_proc_carne_2","acta_proc_cuero_2","acta_ten_cuero","administrar_cupos","caza","curt_cust_cuero","tco_cust_carne","tco_cust_cuero_actas");
            $tipo_carpeta=array($admin_dir,"",$regional_dir,$empresa_dir,"",$tecnico_dir);
            $carpetas="('index'";
            for($i=0;$i<count($tipo_carpeta[$rol-1]);$i++){
                $carpetas.=",'".$tipo_carpeta[$rol-1][$i]."'";
                if($i==count($tipo_carpeta[$rol-1])-1){
                    $carpetas.=")";
                }
            }
            $sql ="SELECT cs.itemId from vrhr_snir.core_submodulo cs INNER JOIN vrhr_snir.core_modulo cm on cs.moduloId=cm.itemId
            WHERE cm.carpeta='lagarto_biodiversidad' and cs.carpeta in".$carpetas;
            
            $id_carpetas = $this->dbm->Execute($sql);
            if($id_carpetas){
                $id_carpetas= $id_carpetas->getRows();
            $data;
            for($i=0;$i<count($id_carpetas);$i++){
                $data[]=array($id_usuario,$id_carpetas[$i]["itemId"]);
            }
            $sql_insert="Insert into vrhr_snir.core_usuario_permisos
            (
            usuarioId,
            subModuloId,
            tipo,
            crear,
            editar,
            eliminar,
            dateCreate,
            dateUpdate,
            userCreate,
            userUpdate)
            VALUES(?,?,0,1,1,1,'".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','".$_SESSION["memberId"]."','".$_SESSION["memberId"]."')";
            $this->dbm->bulkBind = true;
					$res=$this->dbm->Execute($sql_insert,$data);
					if($res){
                        $this->dbm->bulkBind = false;
						return true;
					}
					else{
                        $this->dbm->bulkBind = false;
						return false;

					}
            }
            else{
                return false;

            }


        }
        else{
            return true;
        }
    }
    function usuario_rol_save($id,$rol,$ci,$ci_id){
        $sql="Insert into usuario_rol (usuario_itemId,rol_itemId,estado,dateUpdate,dateCreate,userCreate,userUpdate,ci,ci_exp_itemId)
        values ('".$id."','".$rol."',1,'".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','".$_SESSION["memberId"]."','".$_SESSION["memberId"]."','".$ci."','".$ci_id."')";
        $res=$this->dbm->Execute($sql);
        if($res){
            return true;
        }
        else{
            return false;

        }
    }
    function usuario_rol_save_ci($ci,$ci_id,$itemId){
        $sql="UPDATE usuario_rol set ci='".$ci."', ci_exp_itemId='".$ci_id."' where usuario_itemId='".$itemId."'";
        $res=$this->dbm->Execute($sql);
        if($res){
            return true;
        }
        else{
            return false;

        }
    }
    function item_update($rec,$itemId,$que_form,$accion){
        /**
         * preprocesamos los datos
         */
        
        $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion);
        /**
         * Guardo los datos ya procesados
         */
        $respuesta_procesa["password"]=$_POST["pass"];
        $respuesta_procesa["tipoUsuario"]=2;
        $campo_id="itemId";
        $where="";
        $ver=$this->verificar_permiso_usuarios(["1"]);
        if($ver)
        {
            $this->dbm->transOff = 0;
            $this->dbm->BeginTrans();
            $res = $this->item_update_sbm($itemId,$respuesta_procesa,$que_form,$accion,$campo_id,$where);
            if($res["res"]==2){
                $this->dbm->RollbackTrans();
            }
            else{
                $res_us_rol=true;
                if($accion!="update")
                {
                    $rol=$rec["rol_itemId"];
                    $respuesta_ci= $this->procesa_datos("usuario_rol",$rec,$accion);
                    $res_us_menu=$this->usuario_menu_save($rol,$res["id"]);
                    $res_us_rol=$this->usuario_rol_save($res["id"],$rol,$respuesta_ci["ci"],$respuesta_ci["ci_exp_itemId"]);
                    if($res_us_rol==false||$res_us_menu==false){
                        $res["res"] = 2;
                        $res["msg"] = "No se pudieron guardar los datos.";
                        $res["msgdb"] = "";
                        $this->dbm->RollbackTrans();
                    }
                    else{
                        $rec["usuario_itemId"]=$this->dbm->Insert_ID();
                        $res["idUser"]=$rec["usuario_itemId"];
                        $tabla="";
                        if($rol=="2"){
                            $tabla="cazador";
                        }
                        if($rol=="3"){
                
                            $tabla="representante_legal";
                        }
                        if($rol=="4"){
                
                            $tabla="responsable_curtiembre";
                        }
                        if($rol=="5"){
                
                            $tabla="representante_empresa";
                        }
                        if($rol=="2"||$rol=="3"||$rol=="4"||$rol=="5"){
                            $respuesta_procesa = $this->procesa_datos($tabla,$rec,$accion);
                            $res2 = $this->item_update_sbm($itemId,$respuesta_procesa,$tabla,$accion,$campo_id,$where);
                            if($res2["res"]==2){
                                $res=$res2;
                                $this->dbm->RollbackTrans();
                            }
                            else{
                                $this->dbm->commitTrans();   
                            }
                        }  
                        else{
                            $this->dbm->commitTrans();  
                        }
                    }
                }
                else{
                    $respuesta_ci= $this->procesa_datos("usuario_rol",$rec,$accion);
                    $resCI=$this->usuario_rol_save_ci($respuesta_ci["ci"],$respuesta_ci["ci_exp_itemId"],$res["id"]);
                    if($resCI){
                        $res["idUser"]=$_REQUEST["idUser"];
                        $this->dbm->commitTrans();  }
                    else{
                        $res["res"] = 2;
                        $res["msg"] = "No se pudieron guardar los datos.";
                        $res["msgdb"] = "";
                        $this->dbm->RollbackTrans();
                    }
                }
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