<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:23
 */
use Dompdf\Dompdf;
use Dompdf\Options;

class Index extends Table {

    function __construct()
    {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    public function get_item_datatable_Rows(){
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["vicuna"];
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
        //print_struc($this->userId);exit;
        $extraWhere = "";
        $groupBy = "";
        $having = "";
        /**
         * Resultado de la consulta enviada
         */
        $resultado = $this->get_grilla_datatable_simple($db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having,"rigth");
        $resultado["recordsTotal"]=$resultado["recordsFiltered"];
        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */
        foreach ($resultado['data'] as $itemId => $valor) {
            $resultado['data'][$itemId]['dateCreate'] = date_format(date_create($valor['dateCreate']),"d/m/Y H:i:s");
            if($valor['enviado_fecha'] !="")$resultado['data'][$itemId]['enviado_fecha'] = date_format(date_create($valor['enviado_fecha']),"d/m/Y");
            //if($valor['emitido_fecha'] !="")$resultado['data'][$itemId]['emitido_fecha'] = date_format(date_create($valor['emitido_fecha']),"d/m/Y");

        }
        return $resultado;
    }

    function get_item($idItem){
        $info = '';
        if($idItem!=''){

            $sql = "SELECT
                    ct.nombre AS vicuna_tipo
                    ,e.nombre as estado
                    ,i.*
                    FROM ".$this->tabla["vicuna"]." AS i
                    LEFT JOIN ".$this->tabla["c_vicuna_tipo"]." AS ct ON ct.itemId = i.tipo_id
                    left join ".$this->tabla["c_estado"]." AS e ON e.itemId = i.estado_id
                    WHERE i.itemId =  '".$idItem."'";

            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        return $info;
    }

     /**
     * Enviar solicitud
     */
    function enviar($item_id){
        $item = $this->get_resumen($item_id,1);
        $requisitos_cargados = $this->get_requisito_cargado($item['tipo_id'])['cargados'];
        $requisitos_requeridos = $this->get_requisito_requerido($item['tipo_id'])['requeridos'];


        if(isset($item["itemId"]) and  $item["itemId"]!="" ){
            /**
             * Solo podra cambiar de estado si el estado actual se encuentra en
             * registrado u observado
             */
            if($item["estado_id"] == 1 or $item["estado_id"] == 3){
                $error = 0;
                $msg = "";
                if($item["total_especie"]==0){
                    $error = 1;
                    $msg .= "- <strong>No tienes especies registradas.</strong> Tienes que registar especies.  <br>";
                }
                if($item["total_depositado"]<$item["total_depositar"]){
                    $error = 1;
                    $msg .= "- <strong>El monto depositado es menor al monto a depositar.</strong> Registra boletas de deposito.  <br>";
                }
                if($requisitos_cargados < $requisitos_requeridos){
                    $error = 1;
                    $msg .= "- <strong>Cargue todos los documentos obligatorios.</strong> Revise los requisitos. <br>";
                }

                if($error ==0){
                    $rec=array();
                    $rec["estado_id"] = 2;
                    $rec["dateUpdate"] = date("Y-m-d H:i:s");

                    $where = " itemId= '".$item_id."' " ;
                    $tabla = $this->tabla["cites"];
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
                    $res['res'] = 3;
                    $res['msg'] = $msg;
                }
            }else{
                $res['res'] = 2;
                $res['msg'] = "No se puede cambiar de estado a este cite";
            }

        }else{
            $res['res'] = 2;
            $res['msg'] = "El cite que intenta enviar, no existe";
        }
        //return$item;
        return$res;
    }
    public function get_requisito_requerido($tipo_id){

        $sql = "SELECT COUNT(*) as requeridos FROM 
                    (SELECT r.* 
                    FROM ".$this->tabla["c_cites_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId 
                    
                    WHERE cr.cites_tipo_id = '".$tipo_id."'
                    AND r.categoria_id = 2 AND r.activo = 1) as i where i.requerido = 1";

        $info = $this->dbm->execute($sql);
        $item = $info->fields;
        return $item;
    }
    public function get_requisito_cargado($tipo_id){

        $sql = "SELECT COUNT(*) as cargados FROM 
                    (SELECT a.* 
                    FROM ".$this->tabla["c_cites_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId 
                    
                    WHERE cr.cites_tipo_id = '".$tipo_id."'
                    AND r.categoria_id = 2 AND r.activo = 1) as i where i.adjunto_tamano > 0";

        $info = $this->dbm->execute($sql);
        $item = $info->fields;
        return $item;
    }
    /**
     * @param $itemId
     * Imprime
     */
    function imprime($item_id){
        global $smarty,$webm;
        @set_time_limit(0);
        ini_set('memory_limit','800M');
        /**
         * Creamos el objeto dompdf
         */
        $path = dirname(__FILE__);
        $path_print = $path."/view/print";
        $path_print = str_replace("\\","/",$path_print); // Para windows
        $smarty->assign('path_print', $path_print);
        /**
         * Creamos el objeto dompdf
         */
        /**
         * Creamos el objeto dompdf
         */
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('isHtml5ParserEnabled', false);
        //$options->set('debugLayout', TRUE);
        $options->set('enable_debug', TRUE);
        $options->set('defaultMediaType', 'all');
        $options->set('isFontSubsettingEnabled', TRUE);
        $options->setChroot("./../");
        $log = $_SERVER['DOCUMENT_ROOT']."/log.html";

        $pdf = new DOMPDF($options);
        $nombre_archivo = date("Ymd_His_").'- VICUNA ID-'.$item_id.'.pdf';

        /**
         * Datos del usuario
         */
        $smarty->assign('usuario', $_SESSION["userv"]);
        $dateprint =  date("d-m-Y H:i:s");
        $smarty->assign('dateprint', $dateprint);
        /**
         * --------------------------------------------------------
         */
        /**
         * Sacamos los datos del template de impresión del pdf
         */
        $webTemplate = $path_print."/index.tpl";
        $html = $smarty->fetch($webTemplate);
        /**
         * Iniciamos el proceso de creación del PDF
         */
        $pdf->loadHtml($html);
        $pdf->setPaper("letter","portrait");
        $pdf->render();
        $options = array('Attachment'=>false,'compress' => true);
        $pdf->stream($nombre_archivo,$options);
        exit;
    }

    public function get_requisitos($item_id){
        $item1 = $this->get_item($item_id);
        $sql = "SELECT 
                    a.*
                    , cr.itemId AS tipo_requisito_id
                    , r.nombre AS nombre_requisito
                    , r.caducidad
                    , r.requerido
                    , r.categoria_id
                    , r.indice
                    FROM ".$this->tabla["c_vicuna_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId and a.vicuna_id= '".$item_id."'
                    
                    WHERE cr.vicuna_tipo_id = '".$item1['tipo_id']."'
                    AND r.categoria_id = 4 and a.adjunto_tamano > 0 ";

        $info = $this->dbm->execute($sql);
        $item = $info->getRows();
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
         * Especies observados
         */
        $sql = "SELECT * FROM  ".$this->tabla["especie"]." AS a WHERE a.vicuna_id = '".$item["itemId"]."' AND a.estado_id = 3";

        $sql = "SELECT e.nombre , e.nombre_comun ,a.* 
                FROM  ".$this->tabla["especie"]." AS a 
                LEFT JOIN ".$this->tabla["c_especie"]." AS e ON e.itemId = a.especie_id
                WHERE a.vicuna_id = '".$item["itemId"]."' AND a.estado_id = 3";


        $info = $this->dbm->Execute($sql);
        $especies = $info->getRows();
        $especies_total = count($especies);

        $smarty->assign("especies",$especies);
        $smarty->assign("especies_total",$especies_total);

        /**
         * Requisitos observados
         */
        $sql = "SELECT * FROM  ".$this->tabla["archivo"]." AS a WHERE a.vicuna_id = '".$item["itemId"]."' AND a.estado_id = 3";
        $info = $this->dbm->Execute($sql);
        $requisitos = $info->getRows();
        $requisitos_total = count($requisitos);

        $smarty->assign("requisitos",$requisitos);
        $smarty->assign("requisitos_total",$requisitos_total);

        /**
         * Pagos observaciones
         */
        $sql = "SELECT * FROM  ".$this->tabla["empresa_pago"]." AS a WHERE a.vicuna_id = '".$item["itemId"]."' AND a.estado_id = 3 AND a.categoria_id = 2";
        $info = $this->dbm->Execute($sql);
        $pagos = $info->getRows();
        $pagos_total = count($requisitos);

        $smarty->assign("pagos",$pagos);
        $smarty->assign("pagos_total",$pagos_total);

        /**
         * Sacamos los datos del usuario para enviar el correo electrónico
         */
        $sql = "SELECT u.usuario, u.nombre, u.apellido
                FROM empresa AS e 
                LEFT JOIN seth_cites_core.usuario AS u ON u.itemId = e.usuario_id
                WHERE e.itemId = '".$item["empresa_id"]."'";
        $info = $this->dbm->Execute($sql);
        $usr = $info->fields;

        /**
         * Enviamos a la vista las variables para crear el correo
         */
        $to["email"] = $usr["usuario"];
        $to["name"] = $usr["nombre"]." ".$usr["apellido"];

        $asunto = "[CITES] - Tiene Observaciones al registro de solicitud de Marca Vicuna";
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

        $item = $this->get_resumen($item_dato["item_id"],1);
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
                    //$rec["estado_id"] = 2;
                    $rec["observacion_fecha"] = $rec["dateUpdate_nucleo"] = date("Y-m-d H:i:s");
                    $rec["observacion_user"] = $rec["userUpdate_nucleo"] = $this->userId;

                    $where = " itemId= '".$item_id."' " ;
                    $tabla = $this->tabla["vicuna"];
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
                $res['msg'] = "No se puede cambiar de estado a esta solicitud";
            }

        }else{
            $res['res'] = 2;
            $res['msg'] = "La solicitud que quiere observar, no existe";
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
         * Sacamos los datos del usuario para enviar el correo electrónico
         */
        $sql = "SELECT u.usuario, u.nombre, u.apellido
                FROM empresa AS e 
                LEFT JOIN seth_cites_core.usuario AS u ON u.itemId = e.usuario_id
                WHERE e.itemId = '".$item["empresa_id"]."'";
        $info = $this->dbm->Execute($sql);
        $usr = $info->fields;

        /**
         * Enviamos a la vista las variables para crear el correo
         */
        $to["email"] = $usr["usuario"];
        $to["name"] = $usr["nombre"]." ".$usr["apellido"];

        $asunto = "[CITES] - Felicidades!!! Su solicitud de Marca Vicuña fue aprobado";
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
        $item = $this->get_resumen($item_dato["item_id"],1);

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
                    //$rec["estado_id"] = 2;
                    $rec["aprobado_fecha"] = $rec["dateUpdate_nucleo"] = date("Y-m-d H:i:s");
                    $rec["aprobado_user"] = $rec["userUpdate_nucleo"] = $this->userId;

                    $where = " itemId= '".$item_id."' " ;
                    $tabla = $this->tabla["vicuna"];
                    
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
                $res['msg'] = "No se puede cambiar de estado a esta solicitud";
            }

        }else{
            $res['res'] = 2;
            $res['msg'] = "El tramite que quiere observar, no existe";
        }

        return$res;
    }

    /**
     * Get Resumen
     */
    function get_resumen($idItem,$all=0){
        /**
         * Para observaciones
         */
        $sql = "SELECT *
                FROM vicuna AS c
                WHERE c.itemId = '".$idItem."' ";

        $info = $this->dbm->Execute($sql);
        $item = $info->fields;

        $sql = "SELECT
                c.requisitos_observado as obs_form2
                ,(SELECT COUNT(*)  FROM ".$this->tabla["archivo"]." AS ea WHERE ea.vicuna_id = c.itemId AND ea.estado_id=3 ) AS obs_requisitos
                FROM vicuna AS c
                WHERE c.itemId = '".$idItem."' ";


        $info = $this->dbm->Execute($sql);
        $item_obs = $info->fields;

        $total =  $item_obs["obs_form2"]+ $item_obs["obs_requisitos"];
        $item_obs["obs_total"] = $total;

        $item = array_merge($item,$item_obs);
        print_struc($item);exit();
        return $item;

    }
}