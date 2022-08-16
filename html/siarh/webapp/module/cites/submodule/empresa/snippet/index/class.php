<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:23
 */
use Dompdf\Dompdf;

class Index extends Table {

    function __construct()
    {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    public function grilla_label_replace($grilla_opt,$busca="",$remplaza=""){
        $grilla = $this->grilla[$grilla_opt];
        $nuevo = array();
        foreach ($grilla as $row){
            $row["label"] = str_replace($busca,$remplaza,$row["label"]);
            $nuevo[] = $row;
        }
        $this->grilla[$grilla_opt] = $nuevo;
    }

    function get_item($idItem,$tipoTabla="item"){

       //$this->dbm->debug=true;
        $info = '';
        if($idItem!=''){

                $sqlSelect = ' i.*
                           , u1.usuario as userCreater
                           , u2.usuario as userUpdater
                           , CONCAT_WS(" ",u3.nombre,u3.apellido) as userUpdater_nucleo
                           , et.nombre AS empresa_tipo 
                           , es.nombre as estado
                           ';
                $sqlFrom = ' '.$this->tabla["empresa"].' i
                
                LEFT JOIN '.$this->tabla["c_empresa_tipo"].' AS et ON et.itemId = i.tipo_id
                left join '.$this->tabla["c_empresa_estado"].' AS es ON es.itemId = i.estado_id
                         LEFT JOIN '.$this->tabla["core_cites_usuario"].' u1 on u1.itemId=i.userCreate
                         LEFT JOIN '.$this->tabla["core_cites_usuario"].' u2 on u2.itemId=i.userUpdate
                         LEFT JOIN '.$this->tabla["o_usuario"].' u3 on u3.itemId=i.userUpdate_nucleo                         
                         ';
                $sqlWhere = " i.itemId='".$idItem."'";
                $sqlGroup = ' ';

            $sql = 'SELECT '.$sqlSelect.'
                  FROM '.$sqlFrom.'
                  WHERE '.$sqlWhere.'
                  '.$sqlGroup;
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
            /*
            print_struc($info);
            exit;
            */
        }
        return $info;
    }


    public function get_item_datatable_Rows(){
        global $db_conf_datatable;
        //print_struc($this);exit();
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["empresa"];
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



        foreach ($resultado['data'] as $itemId => $valor) {
            $resultado['data'][$itemId]['dateCreate'] = date_format(date_create($valor['dateCreate']),"d/m/Y H:i:s");
            if($valor['dateUpdate'] !="")$resultado['data'][$itemId]['dateUpdate'] = date_format(date_create($valor['dateUpdate']),"d/m/Y H:i:s");
            if($valor['enviado_fecha'] !="")$resultado['data'][$itemId]['enviado_fecha'] = date_format(date_create($valor['enviado_fecha']),"d/m/Y H:i:s");
            if($valor['aprobado_fecha'] !="")$resultado['data'][$itemId]['aprobado_fecha'] = date_format(date_create($valor['aprobado_fecha']),"d/m/Y H:i:s");
        }

        return $resultado;

    }

    /**
     * Get Resumen
     */
    function get_resumen($item_dato,$all=0){

        $sql = "SELECT 
                e.observado as obs_general
                ,e.requisitos_observado as obs_form2
                ,(SELECT COUNT(*)  FROM ".$this->tabla["empresa_archivo"]." AS ea WHERE ea.empresa_id = e.itemId AND ea.estado_id=3 ) AS obs_requisitos
                ,(SELECT COUNT(*) FROM ".$this->tabla["empresa_pago"]." AS ep WHERE ep.empresa_id = e.itemId AND ep.categoria_id =1 AND ep.estado_id=3) AS obs_pagos";
        if($all==1){
            $sql .= " 
                    , u.usuario
                    , u.nombre as usr_nombre
                    , u.apellido as usr_apellido
                    , e.* 
            ";
        }

        $sql .= " 
                
                FROM ".$this->tabla["empresa"]." AS e 
                left join ".$this->tabla["core_cites_usuario"]." as u on u.itemId = e.usuario_id
                WHERE e.itemId = '".$item_dato["item_id"]."' ";

        $info = $this->dbm->Execute($sql);
        $item = $info->fields;

        $total = $item["obs_general"] +  $item["obs_form2"]+ $item["obs_requisitos"]+ $item["obs_pagos"];
        $item["obs_total"] = $total;
        return $item;

    }


    function enviar_obs_email($item){
        global $modulo_core,$smarty;
        /**
         * sacamos el detalle de las observaciones
         */
        //print_struc($item);exit;
        $smarty->assign("item",$item);

        /**
         * Requisitos observados
         */
        $sql = "SELECT * FROM  ".$this->tabla["empresa_archivo"]." AS a WHERE a.empresa_id = '".$item["itemId"]."' AND a.estado_id = 3";
        $info = $this->dbm->Execute($sql);
        $requisitos = $info->getRows();
        $requisitos_total = count($requisitos);

        $smarty->assign("requisitos",$requisitos);
        $smarty->assign("requisitos_total",$requisitos_total);

        /**
         * Pagos observaciones
         */
        $sql = "SELECT * FROM  ".$this->tabla["empresa_pago"]." AS a WHERE a.empresa_id = '".$item["itemId"]."' AND a.estado_id = 3 AND a.categoria_id = 1";
        $info = $this->dbm->Execute($sql);
        $pagos = $info->getRows();
        $pagos_total = count($requisitos);

        $smarty->assign("pagos",$pagos);
        $smarty->assign("pagos_total",$pagos_total);


        /**
         * Enviamos a la vista las variables para crear el correo
         */
        $to["email"] = $item["usuario"];
        $to["name"] = $item["usr_nombre"]." ".$item["usr_apellido"];

        $asunto = "[CITES] - Tiene Observaciones al registro de usuario";
        $envio = $modulo_core->send_email_system($to,$asunto);


        if($envio["res"]==2){
            $resp["resp"] = 2;
            $resp["msg"] = $envio["msgdb"];
        }else{
            $resp["resp"] = 1;
            $resp["msg"] = "Se ha enviado un correo electrónico al usuario";
        }
        return $resp;
    }

    function enviar_obs($item_dato){
        $item = $this->get_resumen($item_dato,1);
        $item_id = $item_dato["item_id"];
        if(isset($item["itemId"]) and  $item["itemId"]!="" ){
            /**
             * Solo podra cambiar de estado si el estado actual se encuentra en
             * "Proceso de validación"
             */
            if($item["estado_id"] == 2){

                $error = 0;
                $msg = "";
                if($item["obs_total"]==0){
                    $error = 1;
                    $msg .= "- <strong>No tienes observaciones registradas.</strong> Tienes que registar observaciones.  <br>";
                }

                if($error ==0){
                    $rec=array();
                    $rec["estado_id"] = 3;
                    $rec["observacion_fecha"] = $rec["dateUpdate_nucleo"] = date("Y-m-d H:i:s");
                    $rec["observacion_user"] = $rec["userUpdate_nucleo"] = $this->userId;

                    $where = " itemId= '".$item_id."' " ;
                    $tabla = $this->tabla["empresa"];
                    $resupdate = $this->dbm->AutoExecute($tabla,$rec,'UPDATE',$where);

                    if($resupdate){
                        $res["res"] = 1;
                        $res['msg'] = "Se envio el registro";
                        $this->enviar_obs_email($item);
                        /**
                         * Iniciamos el proceso de envio de correo electrónico
                         */
                    }else{
                        $res["res"] = 2;
                        $res["msg"] = "No se logro actualizar la informacion en la B.D.";
                        $res["msgdb"] = $this->dbm->ErrorMsg();
                    }

                }else{
                    $res['res'] = 3;
                    $res['msg'] = $msg;
                }
            }else{
                $res['res'] = 2;
                $res['msg'] = "No se puede cambiar de estado a este usuario";
            }

        }else{
            $res['res'] = 2;
            $res['msg'] = "El usuario que quiere observar, no existe";
        }

        return$res;
    }



    function enviar_aprobar_email($item){
        global $modulo_core,$smarty;
        /**
         * sacamos el detalle de las observaciones
         */
        //print_struc($item);exit;
        $smarty->assign("item",$item);
        /**
         * Enviamos a la vista las variables para crear el correo
         */
        $to["email"] = $item["usuario"];
        $to["name"] = $item["usr_nombre"]." ".$item["usr_apellido"];
        $asunto = "[CITES] - Felicidades!!! Su Registro fue aprobado";
        $envio = $modulo_core->send_email_system($to,$asunto);

        if($envio["res"]==2){
            $resp["resp"] = 2;
            $resp["msg"] = $envio["msgdb"];
        }else{
            $resp["resp"] = 1;
            $resp["msg"] = "Se ha enviado un correo electrónico al usuario";
        }
        return $resp;
    }

    function enviar_aprobar($item_dato){
        $item = $this->get_resumen($item_dato,1);
        $item_id = $item_dato["item_id"];
        if(isset($item["itemId"]) and  $item["itemId"]!="" ){
            /**
             * Solo podra cambiar de estado si el estado actual se encuentra en
             * "Proceso de validación"
             */
            if($item["estado_id"] == 2){

                $error = 0;
                $msg = "";
                if($item["obs_total"]!=0){
                    $error = 1;
                    $msg .= "- <strong>Tienes observaciones registradas.</strong> No puede Aprobar esta solicitud. <br>";
                }

                if($error ==0){
                    $rec=array();
                    $rec["estado_id"] = 4;
                    $rec["aprobado_fecha"] = $rec["dateUpdate_nucleo"] = date("Y-m-d H:i:s");
                    $rec["aprobado_user"] = $rec["userUpdate_nucleo"] = $this->userId;

                    $where = " itemId= '".$item_id."' " ;
                    $tabla = $this->tabla["empresa"];
                    $resupdate = $this->dbm->AutoExecute($tabla,$rec,'UPDATE',$where);
                    //
                    if($resupdate){
                        $res["res"] = 1;
                        $res['msg'] = "Se envio el registro";
                        $this->enviar_aprobar_email($item);
                        /**
                         * Iniciamos el proceso de envio de correo electrónico
                         */
                    }else{
                        $res["res"] = 2;
                        $res["msg"] = "No se logro actualizar la informacion en la B.D.";
                        $res["msgdb"] = $this->dbm->ErrorMsg();
                    }

                }else{
                    $res['res'] = 3;
                    $res['msg'] = $msg;
                }
            }else{
                $res['res'] = 2;
                $res['msg'] = "No se puede cambiar de estado a este usuario";
            }

        }else{
            $res['res'] = 2;
            $res['msg'] = "El usuario que quiere observar, no existe";
        }

        return$res;
    }
}