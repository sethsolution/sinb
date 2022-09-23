<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:23
 */
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    //Page header
    public function Header() {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // set bacground image
        //echo K_PATH_IMAGES;exit;
        //$img_file = K_PATH_IMAGES.'image_demo.jpg';
        $img_file = './module/cites/template/images/pdf/cites_certificado.png';
        //$this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }
}


class Index extends Table {

    function __construct()
    {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    public function get_item_datatable_Rows($especie_id){
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["dispensacion"];
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
        if($especie_id !=""){
            $extraWhere .= " i.itemId IN ( SELECT ii.cites_id FROM cites_especie AS ii WHERE ii.especie_id= '".$especie_id."' ) ";
        }

        $groupBy = "";
        $having = "";
        /**
         * Resultado de la consulta enviada
         */
        $resultado = $this->get_grilla_datatable_simple($db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having,"right");
        $resultado["recordsTotal"]=$resultado["recordsFiltered"];
        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */
        foreach ($resultado['data'] as $itemId => $valor) {
            $field = "dateCreate";
            if(isset($result['data'][$itemId][$field]) && $result['data'][$itemId][$field]!="" ) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y H:i:s");
            $field = "dateUpdate";
            if(isset($result['data'][$itemId][$field]) && $result['data'][$itemId][$field]!="" ) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y H:i:s");

            $field = "enviado_fecha";
            if(isset($result['data'][$itemId][$field]) && $result['data'][$itemId][$field]!="" ) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y");
            $field = "emitido_fecha";
            if(isset($result['data'][$itemId][$field]) && $result['data'][$itemId][$field]!="" ) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y");
            $field = "fecha_expiracion";
            if(isset($result['data'][$itemId][$field]) && $result['data'][$itemId][$field]!="" ) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y");
        }
        return $resultado;
    }

    function get_item($idItem){

        $info = '';
        if($idItem!=''){

            $sql = "SELECT
            ct.nombre AS dispensacion_tipo
            ,e.nombre as estado
            , ct.monto AS monto
            , p1.nombre as paisimportador
            , p2.nombre as paisexportador 
            , d.nombre as documento
            , pr.nombre as proposito
            ,i.*
            FROM ".$this->tabla["dispensacion"]." AS i
            LEFT JOIN ".$this->tabla["c_dispensacion_tipo"]." AS ct ON ct.itemId = i.tipo_id
            left join ".$this->tabla["c_estado"]." AS e ON e.itemId = i.estado_id
            LEFT JOIN ".$this->tabla["c_pais"]." AS p1 ON p1.itemId = i.importacion_pais_id
            LEFT JOIN ".$this->tabla["c_pais"]." AS p2 ON p2.itemId = i.exportador_pais_id
            LEFT JOIN ".$this->tabla["c_tipo_documento"]." AS d ON d.itemId = i.tipo_documento_id
            LEFT JOIN ".$this->tabla["c_tipo_proposito"]." AS pr ON pr.itemId = i.proposito_id
            WHERE i.itemId =  '".$idItem."' ";

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
        $sql = "SELECT 
                ct.nombre AS cites_tipo
                , e.nombre as estado
                , ct.monto AS monto
              
                , (SELECT SUM(p.monto)  FROM ".$this->tabla["empresa_pago"]." AS p WHERE p.dispensacion_id = i.itemId AND p.empresa_id = i.empresa_id) AS total_depositado
                , (SELECT COUNT(*)  FROM ".$this->tabla["especie"]."  AS e WHERE e.dispensacion_id = i.itemId AND e.empresa_id = i.empresa_id) AS total_especie ";
        if($all==1){
            $sql .= " , i.* ";
        }
        $sql .= "FROM ".$this->tabla["dispensacion"]." AS i
                LEFT JOIN ".$this->tabla["c_dispensacion_tipo"]." AS ct ON ct.itemId = i.tipo_id
                left join ".$this->tabla["c_estado"]." AS e ON e.itemId = i.estado_id
                WHERE i.itemId =  '".$idItem."' ";

        $info = $this->dbm->Execute($sql);
        $item = $info->fields;


        //print_struc($total);exit;

        /**
         * Sacamos la cantidad certificados que deberia generar y pagar
         */
        $especie_max = 8;
        $especie  = $item["total_especie"];
        $cert_entero = floor($especie / $especie_max);
        $cert_resto = $especie  % $especie_max;
        /**
         * Calcula la cantidad de certificados necesarios
         */
        if($cert_resto==0){
            $total_certificado = $cert_entero;
        }else{
            $total_certificado = $cert_entero + 1;
        }

        /**
         * Calculamos el total a pagar
         */
        $total_depositar = $total_certificado * $item["monto"];
        /**
         * añadir datos al arreglo
         */
        $item["total_certificado"] = $total_certificado;
        $item["total_depositar"] = $total_depositar;

        //print_struc($item);exit();

        /**
         * Para observaciones
         */
        $sql = "SELECT
                c.observado as obs_general
                ,c.requisitos_observado as obs_form2
        
                ,(SELECT COUNT(*)  FROM ".$this->tabla["archivo"]." AS ea WHERE ea.dispensacion_id = c.itemId AND ea.estado_id=3 ) AS obs_requisitos
                ,(SELECT COUNT(*) FROM ".$this->tabla["empresa_pago"]." AS ep WHERE ep.dispensacion_id = c.itemId AND ep.categoria_id =2 AND ep.estado_id=3) AS obs_pagos
                ,(SELECT COUNT(*) FROM ".$this->tabla["especie"]." AS es WHERE es.dispensacion_id = c.itemId AND es.estado_id=3) AS obs_especies
                FROM dispensacion AS c                
                WHERE c.itemId = '".$idItem."' ";

        $info = $this->dbm->Execute($sql);
        $item_obs = $info->fields;

       /* if ($item_obs["sustitucion_cites"]==0){
           $total = $item_obs["obs_general"] +  $item_obs["obs_form2"]+ $item_obs["obs_requisitos"]+ $item_obs["obs_pagos"] + $item_obs["obs_especies"];
        }else{
            $total = $item_obs["obs_general"] +  $item_obs["obs_form2"]+ $item_obs["obs_requisitos"]+ $item_obs["obs_especies"]
                + $item_obs["obs_sustitucion_requisitos"] + $item_obs["obs_sustitucion_pagos"] + $item_obs["obs_sustitucion_form"];
        }*/

        $total = $item_obs["obs_general"] +  $item_obs["obs_form2"]+ $item_obs["obs_requisitos"]+ $item_obs["obs_pagos"]+ $item["obs_especies"];
        $item_obs["obs_total"] = $total;
        $item = array_merge($item,$item_obs);

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
                    FROM ".$this->tabla["c_dispensacion_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId and a.dispensacion_id= '".$item_id."'
                    
                    WHERE cr.dispensacion_tipo_id = '".$item1['tipo_id']."'
                    AND r.categoria_id = 2 and a.adjunto_tamano > 0 ";

        $info = $this->dbm->execute($sql);
        $item = $info->getRows();

        return $item;
    }

    /**
     * @param $itemId
     * Imprime
     */
    function imprime($item_id){
        global $objCatalog,$objItem;
        /**
         * Datos de la cite
         */
        $objCatalog->conf_catalog_datos_general_print();
        $cataobj = $objCatalog->getCatalogList();
        $item = $objItem->get_item($item_id);
        $especie = $objItem->get_especie_list($item_id);
        /*-
         print_struc($especie);
         print_struc($item);
         print_struc($cataobj);
         exit;
        /**
         * ------------------------------------------------------------------------------------------------------
         */

        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Cites Bolivia - NO OFICIAL');
        $pdf->SetTitle('Certificado de Dispesnación');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('CITES,Bolivia');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);
        // remove default footer
        $pdf->setPrintFooter(false);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------
        // set font
        //$pdf->SetFont('times', '', 48);
        $pdf->SetFont('helvetica', '', 7);
        // add a page
        $pdf->AddPage();

        /**
         * 1. Exportación
         */
        $txt = 'X';
        // Exportación
        if($item["tipo_documento_id"]==1)
            $pdf->MultiCell(5, 0, $txt, 0, 'J', 0, 1, '17', '25', true, 0, false, true, 0);
        // Re-Exportación
        if($item["tipo_documento_id"]==2)
            $pdf->MultiCell(5, 0, $txt, 0, 'J', 0, 1, '17', '31', true, 0, false, true, 0);
        // Importación
        if($item["tipo_documento_id"]==3)
            $pdf->MultiCell(5, 0, $txt, 0, 'J', 0, 1, '79', '25', true, 0, false, true, 0);
        // Otro
        if($item["tipo_documento_id"]==4)
            $pdf->MultiCell(5, 0, $txt, 0, 'J', 0, 1, '79', '31', true, 0, false, true, 0);

        /**
         * 2. Vàlido hasta
         */
        //
        //$item["fecha_expiracion"] = '2020-08-01';

        if($item["fecha_expiracion"]!=""){
            $date = new DateTime($item["fecha_expiracion"]);
            $txt = $date->format('d/m/Y');
            $pdf->MultiCell(43, 0, $txt."\n", 0, 'L', 0, 1, '161', '30', true, 0, false, true, 0);
        }

        /**
         * 3. Importador
         */
        $txt =  $item["importador_nombre"]."\n";
        $txt .= $item["importador_direccion"]."\n";
        $pdf->MultiCell(92, 21, $txt, 0, 'L', 0, 1, '12', '48', true, 1, false, true, 21);

        /**
         * 3a País
         */

        $txt = $cataobj["pais"][$item["importacion_pais_id"]];
        $pdf->MultiCell(69, 7, $txt, 0, 'L', 0, 1, '35', '70', true, 1, false, true, 7);

        /**
         * 4. Exportador
         */

        $txt =  $item["exportador_nombre"]."\n";
        $txt .= $item["exportador_direccion"]."\n";
        $txt .= $cataobj["pais"][$item["exportador_pais_id"]]."\n";

        $pdf->MultiCell(92, 21, $txt, 0, 'J', 0, 1, '106', '48', true, 1, false, true, 21);

        /**
         * 5. Condiciones Especiales
         */
        $txt =  $item["condiciones_especiales"];
        $pdf->MultiCell(92, 25, $txt, 0, 'J', 0, 1, '12', '83', true, 1, false, true, 25);

        /**
         * 6. autoridad adminsitartiva
         */

        $txt = $item["autoridad_administrativa"];
        $pdf->MultiCell(53, 38, $txt, 0, 'C', 0, 1, '145', '76', true, 1, false, true, 38);

        /**
         * 5a. Condiciones Especiales.
         */
        //$txt = $cataobj["tipo_proposito"][$item["proposito_id"]];
        $txt = $cataobj["tipo_proposito"][$item["proposito_id"]];
        //$txt =  "T";
        $pdf->MultiCell(5, 3, $txt, 0, 'L', 0, 1, '77', '112', true, 0, false, true, 0);

        foreach ($especie as $clave=>$row){

            switch ($clave){
                case 0:
                    $border = 0;
                    $y_f = 128;
                    break;
                case 1:
                    $border = 0;
                    $y_f = 144;
                    break;
                case 2:
                    $border = 0;
                    $y_f = 161;
                    break;
                case 3:
                    $border = 0;
                    $y_f = 178;
                    break;
                case 4:
                    $border = 0;
                    $y_f = 194;
                    break;
                case 5:
                    $border = 0;
                    $y_f = 210;
                    break;
                case 6:
                    $border = 0;
                    $y_f = 226;
                    break;
                case 7:
                    $border = 0;
                    $y_f = 242;
                    break;
            }
            /**
             * 7/8 Nombre científico y nombre común del animal o planta ( genero /especie )
             */

            $txt = $row["nombre_comun"];
            //$border = 1;
            $pdf->MultiCell(34, 14, $txt, $border, 'L', 0, 1, '15', $y_f+0, true, 1, false, true, 7);

            $txt = $row["nombre"];
            $pdf->SetFont('helvetica', 'I', 8);
            $pdf->MultiCell(34, 7, $txt, $border, 'L', 0, 1, '15', $y_f+7, true, 1, false, true, 7);
            $pdf->SetFont('helvetica', '', 7);


            /**
             * 9 Descripción de los especímenes
             */
            $txt = $row["descripcion"]."\n";
            $pdf->MultiCell(76, 14, $txt, $border, 'L', 0, 1, '75', $y_f+0, true, 1, false, true, 14);
            /**
             * 10. Cantidad
             */
            $txt = $row["unidad"];
            $pdf->MultiCell(36, 5, $txt, $border, 'L', 0, 1, '162', $y_f+0, true, 0, false, true, 0);
            /**
             * Permiso N
             */
            $txt = $row["numero_permiso"];
            $pdf->MultiCell(15, 0, $txt, $border, 'L', 0, 1, '183', $y_f+11, true, 0, false, true, 0);
        }
        /**
         * 13 Este Permiso es emitido por
         */
        $border = 0;

        //$txt = "La Paz";
        $txt = $item["emitido_lugar"];
        $pdf->MultiCell(40, 0, $txt, $border, 'C', 0, 1, '50', 260, true, 0, false, true, 0);


        if($item["emitido_fecha"]!=""){
            $date = new DateTime($item["emitido_fecha"]);
            $txt = $date->format('d-m-Y');
            $txt = $objItem->obtenerFechaLiteral($txt);
            //$txt = "";
            $pdf->MultiCell(33, 0, $txt, $border, 'C', 0, 1, '42', 267, true, 0, false, true, 0);
        }

// ---------------------------------------------------------

//Close and output PDF document
        $pdf->Output('example_051.pdf', 'I');
        exit;
    }


    function obtenerFechaLiteral($fecha){
        $num = date("j", strtotime($fecha));
        $anno = date("Y", strtotime($fecha));
        $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        $mes = $mes[(date('m', strtotime($fecha))*1)-1];
        return $num.' de '.$mes.' de '.$anno;
    }

    /**
     * Get especies para resumen
     */
    function get_especie_list($item_id){

        $sql = "select CONCAT(e.nombre_comun,' - ',e.nombre) as nombre_especie,  e.nombre_comun, e.nombre,
        p.descripcion, CONCAT(p.cantidad,'  ',u.unidad) as unidad
        from ".$this->tabla["especie"]." as p 
        LEFT JOIN ".$this->tabla["c_especie"]." AS e ON e.itemId = p.especie_id
        LEFT JOIN ".$this->tabla["c_tipo_unidad"]."  AS u ON u.itemId = p.unidad_id
        where dispensacion_id='".$item_id."'";
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
        $sql = "SELECT * FROM  ".$this->tabla["especie"]." AS a WHERE a.dispensacion_id = '".$item["itemId"]."' AND a.estado_id = 3";

        $sql = "SELECT e.nombre , e.nombre_comun ,a.* 
                FROM  ".$this->tabla["especie"]." AS a 
                LEFT JOIN ".$this->tabla["c_especie"]." AS e ON e.itemId = a.especie_id
                WHERE a.dispensacion_id = '".$item["itemId"]."' AND a.estado_id = 3";

        $info = $this->dbm->Execute($sql);
        $especies = $info->getRows();
        $especies_total = count($especies);

        $smarty->assign("especies",$especies);
        $smarty->assign("especies_total",$especies_total);

        /**
         * Requisitos observados
         */
        $sql = "SELECT * FROM  ".$this->tabla["archivo"]." AS a WHERE a.dispensacion_id = '".$item["itemId"]."' AND a.estado_id = 3";
        $info = $this->dbm->Execute($sql);
        $requisitos = $info->getRows();
        $requisitos_total = count($requisitos);

        $smarty->assign("requisitos",$requisitos);
        $smarty->assign("requisitos_total",$requisitos_total);

        /**
         * Pagos observaciones
         */
        $sql = "SELECT * FROM  ".$this->tabla["empresa_pago"]." AS a WHERE a.dispensacion_id = '".$item["itemId"]."' AND a.estado_id = 3 AND a.categoria_id = 2";
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

        $asunto = "[CITES] - Tiene Observaciones al registro de solicitud DISPENSACIÓN";
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
                    $tabla = $this->tabla["dispensacion"];
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
            $res['msg'] = "La disepensación que quiere observar, no existe";
        }

        return$res;
    }



    function enviar_aprobar_email($item){
        global $modulo_core,$smarty;
        /**
         * sacamos el detalle de las observaciones
         */
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

        $asunto = "[CITES] - Felicidades!!! Su solicitud de DISPENSACIÓN fue aprobado";
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
                if($item["info_final"]==0){
                    $error = 1;
                    $msg .= "- <strong>INFORMACIÓN FINAL</strong> Tiene que aprobar y guardar la información final.<br>";
                }
                if($item["impreso"]==0){
                    $error = 1;
                    $msg .= "- <strong>REALIZAR LA IMPRESIÓN DEL DOCUMENTO</strong> Confirme la Impresión del Certificado.<br>";
                }

                if($error ==0){
                    $rec=array();
                    $rec["estado_id"] = 4;
                    //$rec["estado_id"] = 2;
                    $rec["aprobado_fecha"] = $rec["dateUpdate_nucleo"] = date("Y-m-d H:i:s");
                    $rec["aprobado_user"] = $rec["userUpdate_nucleo"] = $this->userId;

                    $where = " itemId= '".$item_id."' " ;
                    $tabla = $this->tabla["dispensacion"];

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

        return$res;
    }

}