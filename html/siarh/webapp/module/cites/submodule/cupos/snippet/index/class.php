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

    public function get_item_datatable_Rows(){
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["gestion"];
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
        $resultado = $this->get_grilla_datatable_simple($db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having);
        $resultado["recordsTotal"]=$resultado["recordsFiltered"];
        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */

        foreach ($resultado['data'] as $itemId => $valor) {
            $resultado['data'][$itemId]['dateCreate'] = date_format(date_create($valor['dateCreate']),"d/m/Y H:i:s");
            if($valor['emitido_fecha'] !="")$resultado['data'][$itemId]['emitido_fecha'] = date_format(date_create($valor['emitido_fecha']),"d/m/Y");
            if($valor['fecha_expiracion'] !="")$resultado['data'][$itemId]['fecha_expiracion'] = date_format(date_create($valor['fecha_expiracion']),"d/m/Y");
        }

        return $resultado;
    }

    function get_item($idItem){
        $info = '';
        if($idItem!=''){
            $sql = "SELECT i.* FROM ".$this->tabla["gestion"]." AS i WHERE i.itemId =  '".$idItem."' ";
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        return $info;
    }
    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id){
        /**
         * borramos a los hijos antes de borrar al principal
         */

        /**
         * borramos  el dato principal
         */
        $campo_id="itemId";
        $where =  "";
        $res = $this->item_delete_sbm($id,$campo_id,$this->tabla["cites"], $where);
        return $res;
    }
    /**
     * Get Resumen
     */
    function get_resumen($idItem,$all=0){

        $sql = "SELECT (SELECT SUM(c.cupo_autorizado) FROM cupo AS c WHERE c.gestion_id = g.itemId) AS cupo_total ";
        if($all==1){
            $sql .= " ,g.*";
        }
        $sql .= " FROM gestion AS g WHERE g.itemId='".$idItem."' ";

        $info = $this->dbm->Execute($sql);
        $item = $info->fields;
        return $item;
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
        $dompdf = new DOMPDF();
        $nombre_archivo = date("Ymd_His_").'- CITES ID-'.$item_id.'.pdf';
        /**
         * -------------------------------------------------------------------------------------
         * Sacamos el path del directorio donde se realiza la llamada a los archivos
         */
        $path = dirname(__FILE__);
        $path_print = $path."/view/print";
        /**
         * Para plataformas windows, cambiamos la forma de ingresar al path
         */
        $path_print = str_replace("\\","/",$path_print);
        //print_struc($path_print);
        $smarty->assign('path_print', $path_print);

        /**
         * Datos del usuario
         */
        $smarty->assign('usuario', $_SESSION["userv"]);
        $dateprint =  date("Y-m-d H:i:s");
        $smarty->assign('dateprint', $dateprint);
        /**
         * Sacamos los datos del template de impresión del pdf
         */
        $html = $smarty->fetch($webm["item_print_index"]);
        //print_struc($_SESSION);exit;
        //echo $html;exit;
        /**
         * Iniciamos el proceso de creación del PDF
         */
        $dompdf->loadHtml($html);
        $dompdf->setPaper("letter","portrait");
        $dompdf->render();
        $options[Attachment]=0;
        $dompdf->stream($nombre_archivo,$options);
        exit;
    }
    /**
     * Get especies para la previsualizacion
     */
    function get_especie_list($item_id){
        $sql = "select CONCAT(e.nombre_comun,' - ',e.nombre) as nombre_especie, 
        p.descripcion, a.nombre, CONCAT(p.cantidad,'  ',u.unidad) as unidad, p1.nombre AS pais
        from ".$this->tabla["especie"]." as p 
        LEFT JOIN ".$this->tabla["c_especie"]." AS e ON e.itemId = p.especie_id
        LEFT JOIN ".$this->tabla["c_apendice"]."  AS a ON a.itemId = p.apendice_id
        LEFT JOIN ".$this->tabla["c_tipo_unidad"]."  AS u ON u.itemId = p.unidad_id
        LEFT JOIN ".$this->tabla["c_pais"]."  AS p1 ON p1.itemId = p.pais_id
        where cites_id='".$item_id."'";
        $info = $this->dbm->execute($sql);
        $item = $info->getRows();
        return $item;
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
                    FROM ".$this->tabla["c_cites_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId and a.cites_id= '".$item_id."'
                    
                    WHERE cr.cites_tipo_id = '".$item1['tipo_id']."'
                    AND r.categoria_id = 2 and a.adjunto_tamano > 0 ";

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
        $sql = "SELECT * FROM  ".$this->tabla["especie"]." AS a WHERE a.cites_id = '".$item["itemId"]."' AND a.estado_id = 3";

        $sql = "SELECT e.nombre , e.nombre_comun ,a.* 
                FROM  ".$this->tabla["especie"]." AS a 
                LEFT JOIN ".$this->tabla["c_especie"]." AS e ON e.itemId = a.especie_id
                WHERE a.cites_id = '".$item["itemId"]."' AND a.estado_id = 3";


        $info = $this->dbm->Execute($sql);
        $especies = $info->getRows();
        $especies_total = count($especies);

        $smarty->assign("especies",$especies);
        $smarty->assign("especies_total",$especies_total);

        /**
         * Requisitos observados
         */
        $sql = "SELECT * FROM  ".$this->tabla["archivo"]." AS a WHERE a.cites_id = '".$item["itemId"]."' AND a.estado_id = 3";
        $info = $this->dbm->Execute($sql);
        $requisitos = $info->getRows();
        $requisitos_total = count($requisitos);

        $smarty->assign("requisitos",$requisitos);
        $smarty->assign("requisitos_total",$requisitos_total);

        /**
         * Pagos observaciones
         */
        $sql = "SELECT * FROM  ".$this->tabla["empresa_pago"]." AS a WHERE a.cites_id = '".$item["itemId"]."' AND a.estado_id = 3 AND a.categoria_id = 2";
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

        $asunto = "[CITES] - Tiene Observaciones al registro de solicitud CITES";
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
                    $tabla = $this->tabla["cites"];
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
                $res['msg'] = "No se puede cambiar de estado a este cite";
            }

        }else{
            $res['res'] = 2;
            $res['msg'] = "El cite que quiere observar, no existe";
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

        $asunto = "[CITES] - Felicidades!!! Su solicitud de CITE fue aprobado";
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
                    $tabla = $this->tabla["cites"];
                    //$this->dbm->debug = true;
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
                $res['msg'] = "No se puede cambiar de estado a este CITE";
            }

        }else{
            $res['res'] = 2;
            $res['msg'] = "El CITE que quiere observar, no existe";
        }

        return $res;
    }

}