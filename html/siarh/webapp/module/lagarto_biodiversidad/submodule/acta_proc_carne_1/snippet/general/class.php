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
        $res;
        $rec["gestion_itemId"]=date("Y");
		if(($rec["entregado_carne_segunda"])<0||$rec["entregado_carne_primera"]<0||$rec["entregado_charque"]<0){
			

            $res["res"] = 2;
            $res["msg"] = "Verifique las cantidades negativas";
            $res["msgdb"] = "";
		}
        else if($total[0]==0&&$total[1]==0&&$accion=="new"){

            $res["res"] = 2;
            $res["msg"] = "La cantidad total de carnes y charques es 0";
            $res["msgdb"] = "";
        }
            else{
            if($total[0]<($rec["entregado_carne_primera"]+$rec["entregado_carne_segunda"])&&$accion=="new"){
                
                
                $res["res"] = 2;
                $res["msg"] = "La cantidad entregada de carnes no puede ser mayor que la disponible";
                $res["msgdb"] = "";
            }
            else{
            
                if($total[1]<$rec["entregado_charque"]&&$accion=="new"){
                
                
                    $res["res"] = 2;
                    $res["msg"] = "La cantidad entregada de charque no puede ser mayor que la disponible";
                    $res["msgdb"] = "";
                }
                else{
                    if($this->verificarTiempoResolucion(3)){
                        $ver=$this->verificar_permiso_usuarios(["3"]);
                        if($ver)
                        {
                        $repreId=$this->obtenerRepresentante();
                        $rec["representante_legal_itemId"]=$repreId["itemId"];
                        $rec["estado"]=2;
                        $rec["total_charque"]=$total[1];
                        $rec["total_carne_primera"]=$total[0];
                        $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion);
                        /**
                         * Guardo los datos ya procesados
                         */
                        if($accion=="update"){
                            unset($respuesta_procesa["entregado_carne_primera"]);
                            unset($respuesta_procesa["entregado_carne_segunda"]);
                            unset($respuesta_procesa["entregado_charque"]);
                            unset($respuesta_procesa["total_carne"]);
                            unset($respuesta_procesa["total_charque"]);
                            unset($respuesta_procesa["comunidad"]);
                            $where.="estado=2";
                        }
                        $campo_id="itemId";
                        $where="estado=2";
                            $res = $this->item_update_sbm($itemId,$respuesta_procesa,$que_form,$accion,$campo_id,$where);     
                        }
                        else{
                            
                            $res["res"] = 2;
                            $res["msg"] = "No se logro actualizar la informacion en la B.D.";
                            $res["msgdb"] = $this->dbm->ErrorMsg();
                        }
                    }
                    else{
                        $res["res"] = 2;
                        $res["msg"] = "No esta habilitado para realizar reportes en esta fecha.";
                        $res["msgdb"] = "";
                    }
                    $res["accion"] = $accion;
                    }
            }
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