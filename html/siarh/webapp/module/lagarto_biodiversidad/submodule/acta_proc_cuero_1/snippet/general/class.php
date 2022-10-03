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
	 public function ver_longitudes($data){
		 $ver=true;
		 for($i=0;$i<count($data);$i++){
			 if((int)$data[$i][2]<0){
				 $ver=false;
			 }
			 else{
				 $data[$i][2]=(int)$data[$i][2];
			 }
		 }
		 return $ver;
	 }
    public function guardarDatosLongitud($data,$id,$type){
           
			if(!$this->ver_longitudes($data)){
				
				return false;
			}
			else{
				    $sql="Insert into acta_cuero_longitud(itemId,longitud_cuero_itemId,cantidad,acta_cuero_itemId)
					values (?,?,?,".$id.")
					ON DUPLICATE KEY UPDATE
					itemId=VALUES(itemId),
					longitud_cuero_itemId=VALUES(longitud_cuero_itemId),
					cantidad=VALUES(cantidad),
					acta_cuero_itemId=".$id;
					/*
		* Enable bulk binding
		*/
					$this->dbm->bulkBind = true;
					$res=$this->dbm->Execute($sql,$data);
					if($res){
						return true;
					}
					else{
						return false;

					}
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
    function item_update($rec,$itemId,$que_form,$accion,$total){
        /**
         * preprocesamos los datos
         */
        if($this->verificarTiempoResolucion(3)){
            $rec["gestion_itemId"]=date("Y");
			if((int)$rec["entregado_chalecos"]<0||(int)$rec["entregado_colas"]<0){
				
                
                $res["res"] = 2;
                $res["msg"] = "La cantidad total de chalecos o colas no pueden ser negativas";
                $res["msgdb"] = "";
			}
            else if($total[0]==0&&$total[1]==0&&$accion=="new"){
    
                
                $res["res"] = 2;
                $res["msg"] = "La cantidad total de chalecos y colas es igual o menor a 0";
                $res["msgdb"] = "";
            }
            else{
            if($total[0]<$rec["entregado_chalecos"]&&$accion=="new"){
                
                
                $res["res"] = 2;
                $res["msg"] = "La cantidad entregada de chalecos no puede ser mayor que la disponible";
                $res["msgdb"] = "";
            }
            else{
            
                if($total[1]<$rec["entregado_colas"]&&$accion=="new"){
                
                
                    $res["res"] = 2;
                    $res["msg"] = "La cantidad entregada de colas no puede ser mayor que la disponible";
                    $res["msgdb"] = "";
                }
                else{
                    $repreId=$this->obtenerRepresentante();
                    $rec["representante_legal_itemId"]=$repreId["itemId"];
                    $rec["estado"]=2;
                    $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion);
                    /**
                     * Guardo los datos ya procesados
                     */
                    $filas=json_decode($_POST["filas"]);
                    $campo_id="itemId";
                    $where="";
                    $ver=$this->verificar_permiso_usuarios(["3"]);
                    if($ver)
                    {
                        $this->dbm->transOff = 0;
                        $this->dbm->BeginTrans();
    
                        if($accion=="update"){
                            unset($respuesta_procesa["entregado_chalecos"]);
                            unset($respuesta_procesa["entregado_colas"]);
                            unset($respuesta_procesa["total_chalecos"]);
                            unset($respuesta_procesa["total_colas"]);
                            unset($respuesta_procesa["comunidad"]);
                            unset($respuesta_procesa["gestion_itemId"]);
                            $where.="estado=2";
                        }
                        $res = $this->item_update_sbm($itemId,$respuesta_procesa,$que_form,$accion,$campo_id,$where);            
                                
                        if($accion=="new"){
                            $longRes=$this->guardarDatosLongitud($filas,$res["id"],$accion);
                            if($longRes){
                                $res["atras"] = "se hizo commit";
                                $this->dbm->commitTrans();
                            }
                            else{
                                $res["res"] = 2;
								$res["msg"] = "No se pudieron guardar los datos.";
								$res["msgdb"] = "";
                                $this->dbm->RollbackTrans();
                            }
                        }
                        else{
                            $res["atras"] = "se hizo commit";
                            $this->dbm->commitTrans();
            
                        }
                    }
                    else{
                        
                        $res["res"] = 2;
                        $res["msg"] = "No se logro actualizar la informacion en la B.D.";
                        $res["msgdb"] = $this->dbm->ErrorMsg();
                    }
                    $res["accion"] = $accion;
                    $res["datos1"]=$respuesta_procesa;
                    $res["datos2"]=$filas;
    
                }
        
            }
        }
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