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
                $sql="Insert into tco_custodia_cuero_longitud(itemId,longitud_cuero_itemId,cantidad,tco_custodia_cuero_itemId)
            values (?,?,?,".$id.")
            ON DUPLICATE KEY UPDATE
            itemId=VALUES(itemId),
            longitud_cuero_itemId=VALUES(longitud_cuero_itemId),
            cantidad=VALUES(cantidad),
            tco_custodia_cuero_itemId=".$id;
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
    public function verificarCupo(){
        $sql="SELECT gt.itemId from gestion_tco gt
        INNER JOIN representante_legal rl on rl.tco_itemId=gt.tco_itemId
        INNER JOIN usuario_rol ur on ur.itemId=rl.usuario_itemId
        WHERE ur.usuario_itemId=".$_SESSION["memberId"]." and gt.gestion_itemId=".date("Y");
         $res=$this->dbm->Execute($sql);
         $res=$res->GetRows();
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
            INNER JOIN usuario_rol ur on ur.itemId= rc.usuario_itemId
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
         /**
         * preprocesamos los datos
         */
        
        if((int)$rec["total_carne"]<0||(int)$rec["total_charque"]<0){
			
                
                $res["res"] = 2;
                $res["msg"] = "La cantidad total de carne o charque no pueden ser negativas";
                $res["msgdb"] = "";
		}
        else if($this->verificarTiempoResolucion(2)&&$this->verificarCupo()){
            $rec["fecha_acta"]=date("Y-m-d");
            $rec["gestion_itemId"]=date("Y");
            $repreId=$this->obtenerRepresentante();
            $rec["representante_legal_itemId"]=$repreId["itemId"];
            $respuesta_procesa = $this->procesa_datos($que_form,$rec,$accion);
            /**
             * Guardo los datos ya procesados
             */
            $campo_id="itemId";
            $where="";
            $ver=$this->verificar_permiso_usuarios(["3"]);
            if($ver&&$accion=="new")
            {
                $res = $this->item_update_sbm($itemId,$respuesta_procesa,$que_form,$accion,$campo_id,$where);   
            }
            else{
                
                $res["res"] = 2;
                $res["msg"] = "No se logro actualizar la informacion en la B.D.";
                $res["msgdb"] = $this->dbm->ErrorMsg();
            }
            $res["accion"] = $accion;
            $res["datos1"]=$respuesta_procesa;
            $res["datos2"]=$filas;
            $res["msgdb"] = $this->dbm->ErrorMsg();
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