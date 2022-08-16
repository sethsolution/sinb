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


    function get_item(){
        $sql = "SELECT et.nombre AS empresa_tipo 
                , es.nombre as estado
                ,e.* 
                from ".$this->tabla["empresa"]." AS e 
                LEFT JOIN ".$this->tabla["c_empresa_tipo"]." AS et ON et.itemId = e.tipo_id
                left join ".$this->tabla["c_empresa_estado"]." AS es ON es.itemId = e.estado_id
                WHERE e.itemId= '".$this->empresa_id."'";
        $info = $this->dbm->Execute($sql);
        $info = $info->fields;
        return $info;
    }

    public function get_requisito_requerido(){
        $sql= "SELECT COUNT(*) as requeridos FROM 
                (select r.* FROM ".$this->tabla["c_empresa_tipo_requisito"]." AS er 
                LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = er.requisito_id 
                left  JOIN ".$this->tabla["empresa_archivo"]." AS a ON a.tipo_requisito_id = er.itemId AND a.empresa_id = '".$this->empresa_id."'
                WHERE er.empresa_tipo_id = '".$_SESSION["empresa"]["tipo_id"]."'
                AND r.categoria_id = 1 AND r.activo = 1) as i where i.requerido = 1";
        $info = $this->dbm->execute($sql);
        $item = $info->fields;
        return $item;
    }
    public function get_requisito_cargado(){
        $sql= "SELECT COUNT(*) as cargados FROM 
                (select a.* FROM ".$this->tabla["c_empresa_tipo_requisito"]." AS er 
                LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = er.requisito_id 
                left  JOIN ".$this->tabla["empresa_archivo"]." AS a ON a.tipo_requisito_id = er.itemId AND a.empresa_id = '".$this->empresa_id."'
                WHERE er.empresa_tipo_id = '".$_SESSION["empresa"]["tipo_id"]."'
                AND r.categoria_id = 1 AND r.activo = 1) as i where i.adjunto_tamano > 0";
        $info = $this->dbm->execute($sql);
        $item = $info->fields;
        return $item;
    }
    public function get_requisito_sin_cargado($itemId,$tipo_id){

        $sql = "SELECT 
                    count(*) as cargados
                    FROM ".$this->tabla["c_empresa_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["empresa_archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId and a.empresa_id= '".$itemId."'
                    AND a.empresa_id = '".$this->empresa_id."'
                    WHERE cr.empresa_tipo_id = '".$tipo_id."'
                    AND r.requerido = 1
                    AND a.adjunto_tamano IS null";
        $info = $this->dbm->execute($sql);
        $item = $info->fields;
        return $item["cargados"];
    }
    /**
     * Get Resumen
     */
    function enviar($item_id){

        $item = $this->get_item();
        //$requisitos_cargados = $this->get_requisito_cargado()['cargados'];
        //$requisitos_requeridos = $this->get_requisito_requerido(1)['requeridos'];
        if(isset($item["itemId"]) and  $item["itemId"]!="" ){
            $error = 0;
            $msg = "";

            /**
             * Revisamos si existe algun documento requerido que no haya sido cargado
             */

            $requisitos_sin_cargados = $this->get_requisito_sin_cargado($item['itemId'],$item['tipo_id']);
            if ($requisitos_sin_cargados!=0){
                $error = 1;
                $msg .= "- <strong>REQUISITOS - Cargue todos los documentos obligatorios.</strong> Revise los requisitos. <br>";
            }
            /**
             * Revisamos si llenaron los campos extras
             */

            if($item["requisitos_datos"]==0 and $item["tipo_id"] != 8 and $item["tipo_id"] != 10 and $item["tipo_id"] != 12){
                $error = 1;
                $msg .= "- <strong>REQUISITOS - No Guardo los datos adicionales.</strong> Tienes que registrar los datos adicionales.  <br>";
            }
            /**
             * Revisamos el monto del deposito
             */
            /*if($item["total_depositado"]<$item["total_depositar"]){
                $error = 1;
                $msg .= "- <strong>PASO 4 - El monto depósitado es menor al monto a depósitar.</strong> Registra boletas de depósito.  <br>";
            }*/
            if($error ==0){
            /**
             * Solo podra cambiar de estado si el estado actual se encuentra en
             * registrado u observado
             */
            if($item["estado_id"] == 1 or $item["estado_id"] == 3){
                    $rec=array();
                    $rec["estado_id"] = 2;
                    $rec["dateUpdate"] = date("Y-m-d H:i:s");
                $rec["enviado_fecha"] = date("Y-m-d H:i:s");

                    $where = " itemId = '".$this->empresa_id."' " ;
                    $tabla = $this->tabla["empresa"];
                    $resupdate = $this->dbm->AutoExecute($tabla,$rec,'UPDATE',$where);

                    if($resupdate){
                        $res["res"] = 1;
                        $res['msg'] = "Se envio el registro";
                    }else{
                        $res["res"] = 2;
                        $res["msg"] = "No se logro actualizar la informacion en la B.D.";
                        $res["msgdb"] = $this->dbm->ErrorMsg();
                    }
            }else{
                $res['res'] = 2;
                $res['msg'] = "No se puede cambiar de estado a Esta empresa ";
            }
            }else{
                $res['res'] = 3;
                $res['msg'] = $msg;
            }
        }else{
            $res['res'] = 2;
            $res['msg'] = "El cite que intenta enviar, no existe";
        }

        return$res;
    }

}