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
        $table = $this->tabla["cites"];
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
            if(isset($result['data'][$itemId][$field]) && $result['data'][$itemId][$field]!="" ) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y H:i:s");
            $field = "emitido_fecha";
            if(isset($result['data'][$itemId][$field]) && $result['data'][$itemId][$field]!="" ) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y H:i:s");
            $field = "fecha_expiracion";
            if(isset($result['data'][$itemId][$field]) && $result['data'][$itemId][$field]!="" ) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y H:i:s");
        }

        return $resultado;
    }


    function get_item($idItem){
        $info = '';
        if($idItem!=''){

            $sql = "SELECT
            ct.nombre AS cites_tipo
            ,e.nombre as estado
            , ct.monto AS monto
            , ct.sustitucion_1
            , ct.sustitucion_2
            , ct.sustitucion_3
            , p1.nombre as paisimportador
            , p2.nombre as paisexportador 
            , d.nombre as documento
            , pr.nombre as proposito
            ,i.*
            FROM ".$this->tabla["cites"]." AS i
            LEFT JOIN ".$this->tabla["c_cites_tipo"]." AS ct ON ct.itemId = i.tipo_id
            left join ".$this->tabla["c_estado"]." AS e ON e.itemId = i.estado_id
            LEFT JOIN ".$this->tabla["c_pais"]." AS p1 ON p1.itemId = i.importacion_pais_id
            LEFT JOIN ".$this->tabla["c_pais"]." AS p2 ON p2.itemId = i.exportador_pais_id
            LEFT JOIN ".$this->tabla["c_tipo_documento"]." AS d ON d.itemId = i.tipo_documento_id
            LEFT JOIN ".$this->tabla["c_tipo_proposito"]." AS pr ON pr.itemId = i.proposito_id
            WHERE i.itemId =  '".$idItem."' ";

            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        if($info["sustitucion_cites"]==1){
            switch ($info["sustitucion_numero"]){
                case 1:
                    $monto_sus = $info["sustitucion_1"];
                    break;
                case 2:
                    $monto_sus = $info["sustitucion_2"];
                    break;
                case 3:
                    $monto_sus = $info["sustitucion_3"];
                    break;

            }

            $info["monto_sustitucion"] =$monto_sus;
        }
        return $info;
    }

    function get_item2($idItem){
        $info = '';
        if($idItem!=''){

            $sql = "SELECT
            ct.nombre AS cites_tipo
            ,e.nombre as estado
            , ct.monto AS monto
            , ct.sustitucion_1
            , ct.sustitucion_2
            , ct.sustitucion_3
            , p1.nombre as paisimportador
            , p2.nombre as paisexportador 
            , d.nombre as documento
            , pr.nombre as proposito
            , st.nombre as sustitucion_tipo
            ,i.*
            FROM ".$this->tabla["cites"]." AS i
            LEFT JOIN ".$this->tabla["c_cites_tipo"]." AS ct ON ct.itemId = i.tipo_id
            left join ".$this->tabla["c_estado"]." AS e ON e.itemId = i.estado_id
            LEFT JOIN ".$this->tabla["c_pais"]." AS p1 ON p1.itemId = i.importacion_pais_id
            LEFT JOIN ".$this->tabla["c_pais"]." AS p2 ON p2.itemId = i.exportador_pais_id
            LEFT JOIN ".$this->tabla["c_tipo_documento"]." AS d ON d.itemId = i.tipo_documento_id
            LEFT JOIN ".$this->tabla["c_tipo_proposito"]." AS pr ON pr.itemId = i.proposito_id
            LEFT JOIN ".$this->tabla["sustitucion"]." AS s ON s.cites_id_sustitucion = ".$idItem."
            LEFT JOIN ".$this->tabla["c_sustitucion_tipo"]." AS st ON st.itemId =  s.tipo_id
            WHERE i.itemId =  '".$idItem."'";

            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }

        if($info["sustitucion_cites"]==1){
            switch ($info["sustitucion_numero"]){
                case 1:
                    $monto_sus = $info["sustitucion_1"];
                    break;
                case 2:
                    $monto_sus = $info["sustitucion_2"];
                    break;
                case 3:
                    $monto_sus = $info["sustitucion_3"];
                    break;

            }

            $info["monto_sustitucion"] =$monto_sus;
        }
        return $info;
    }

    /**
     * Get Resumen
     */
    function get_resumen($idItem,$all=0){

        $sql = "SELECT
                ct.nombre AS cites_tipo
                , e.nombre as estado
                , i.estado_id
                , ct.monto AS monto
                , ct.sustitucion_1
                , ct.sustitucion_2
                , ct.sustitucion_3
                , i.sustitucion_cites
                , i.sustitucion_numero
                , i.sustituciones
                , (SELECT SUM(p.monto)  FROM ".$this->tabla["empresa_pago"]." AS p WHERE p.cites_id = i.itemId AND p.empresa_id = i.empresa_id) AS total_depositado
                , (SELECT SUM(p.monto)  FROM empresa_pago AS p WHERE p.cites_id = i.itemId AND p.empresa_id = i.empresa_id and p.categoria_id=6) AS total_sustitucion_depositado
                , (SELECT COUNT(*)  FROM ".$this->tabla["especie"]."  AS e WHERE e.cites_id = i.itemId AND e.empresa_id = i.empresa_id) AS total_especie";
        if($all==1){
            $sql .= " , i.* ";
        }
        $sql .= " FROM ".$this->tabla["cites"]." AS i
                LEFT JOIN ".$this->tabla["c_cites_tipo"]." AS ct ON ct.itemId = i.tipo_id
                left join ".$this->tabla["c_estado"]." AS e ON e.itemId = i.estado_id
                WHERE i.itemId =  '".$idItem."' ";

        $info = $this->dbm->Execute($sql);
        $item = $info->fields;

        /**
         * verificamos si las especies fueron aprobadas
         */

        /**
         * Sacamos la cantidad certificados que deberia generar y pagar
         */
        $especie_max = 6;
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
        //$dato["desembolsado"] = round($info["monto"],2);
       // print_struc($item);exit();
        /**
         * Para observaciones
         */
        $sql = "SELECT
                c.observado as obs_general
                ,c.requisitos_observado as obs_form2
        
                ,(SELECT COUNT(*)  FROM ".$this->tabla["archivo"]." AS ea WHERE ea.cites_id = c.itemId AND ea.estado_id=3 ) AS obs_requisitos
                ,(SELECT COUNT(*) FROM ".$this->tabla["empresa_pago"]." AS ep WHERE ep.cites_id = c.itemId AND ep.categoria_id =2 AND ep.estado_id=3) AS obs_pagos
                ,(SELECT COUNT(*) FROM ".$this->tabla["especie"]." AS es WHERE es.cites_id = c.itemId AND es.estado_id=3) AS obs_especies

                ,(SELECT COUNT(*)  FROM sustitucion_archivo AS sa WHERE sa.sustitucion_id = s.itemId AND sa.estado_id=3 ) AS obs_sustitucion_requisitos
                ,(SELECT COUNT(*) FROM empresa_pago AS sep WHERE sep.cites_id = c.itemId AND sep.sustitucion_id=s.itemId AND sep.categoria_id =6 AND sep.estado_id=3) AS obs_sustitucion_pagos
                , s.observado AS obs_sustitucion_general
                , s.requisitos_observado AS obs_sustitucion_form
                , c.sustitucion_cites       
    
                FROM cites AS c
                LEFT JOIN sustitucion AS s ON s.cites_id_sustitucion = c.itemId
                
                WHERE c.itemId = '".$idItem."' ";

        //print_struc($sql);exit;

        $info = $this->dbm->Execute($sql);
        $item_obs = $info->fields;

        /**
         * Control de archivos revisados y aprobados
         */
        $sql = "SELECT
                     
                (SELECT COUNT(*) FROM ".$this->tabla["numero"]." AS n WHERE n.cites_id = c.itemId) AS numero_asignado
                ,(SELECT COUNT(*) FROM ".$this->tabla["especie"]." AS es WHERE es.cites_id = c.itemId AND es.estado_id != 4) AS especies_aprobadas
                ,(SELECT COUNT(*) FROM ".$this->tabla["empresa_pago"]." AS e WHERE e.cites_id = c.itemId AND e.estado_id != 4) AS pagos_aprobados
                ,(SELECT COUNT(*) FROM ".$this->tabla["archivo"]." AS a WHERE a.cites_id = c.itemId AND a.estado_id != 4 and a.adjunto_tamano IS NOT null) AS archivos_aprobados
    
                FROM cites AS c
                LEFT JOIN sustitucion AS s ON s.cites_id_sustitucion = c.itemId
                
                WHERE c.itemId = '".$idItem."' ";

        $info = $this->dbm->Execute($sql);
        $item_aprobados = $info->fields;



        if ($item_obs["sustitucion_cites"]==0){
            $total = $item_obs["obs_general"] +  $item_obs["obs_form2"]+ $item_obs["obs_requisitos"]+ $item_obs["obs_pagos"] + $item_obs["obs_especies"];
        }else{
            $total = $item_obs["obs_general"] +  $item_obs["obs_form2"]+ $item_obs["obs_requisitos"]+ $item_obs["obs_especies"]
                + $item_obs["obs_sustitucion_requisitos"] + $item_obs["obs_sustitucion_pagos"] + $item_obs["obs_sustitucion_form"];
        }

        $item_obs["obs_total"] = $total;
        //print_struc($item_obs);exit;

        $item = array_merge($item,$item_obs);
        $item = array_merge($item,$item_aprobados);


        //print_struc($this->tabla);exit;

        /**
         * Sustitución
         */
        if($item["sustitucion_cites"]==1){
            /**
             * Sacamos el monto que debe pagar por la sustitución
             */
            switch ($item["sustitucion_numero"]){
                case 1:
                    $monto_sus = $item["sustitucion_1"];
                    break;
                case 2:
                    $monto_sus = $item["sustitucion_2"];
                    break;
                case 3:
                    $monto_sus = $item["sustitucion_3"];
                    break;
            }
            $item["monto_sustitucion"] = $total_certificado * $monto_sus;
            /**
             * Sacamos los datos total de monto depositado para sustitución
             */
            /*
            $sql = "select * from ".$this->tabla["sustitucion"]." where cites_id_sustitucion= '".$idItem."'  and empresa_id= '".$this->empresa_id."' ";
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
            */
        }
        //print_struc($item);exit;
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



    function imprime_excel($item_id){
        $file_excel = "./module/cites/template/excel/ficha_cites.xls";
        $excel = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_excel);

        $excel = $this->autor_reporte($excel);
        $excel = $this->reporte_datos($excel,$item_id);

        $this->descargar_reporte($excel);
    }

    function caracteres($str){
        $str = str_replace("ñ","Ñ",$str);
        return $str;
    }
    function reporte_datos($excel,$item_id){
        $item = $this->get_item($item_id);
        $excel->setActiveSheetIndex(1);


        //3. IMPORTADOR
        $dato = $item["importador_nombre"];
        $dato .= "\n".$item["importador_direccion"];
        $dato = $this->caracteres($dato);
        $excel->getActiveSheet()->setCellValue('B4', $dato);
        //3a. Pais de Importación
        $dato = strtoupper($item["paisimportador"]);
        $dato = $this->caracteres($dato);
        $excel->getActiveSheet()->setCellValue('D4', $dato);


        //4. EXPORTADOR
        $dato = $item["exportador_nombre"];
        $dato .= "\n".$item["exportador_direccion"];
        $dato .= "\n".strtoupper($item["paisexportador"]);
        $excel->getActiveSheet()->setCellValue('C4', $dato);



        return $excel;
    }

    function autor_reporte($excel){
        //Autor del reporte
        $excel->getProperties()
            ->setCreator('Sistemas - MMAyA - CITES')
            ->setLastModifiedBy('Sistemas - MMAyA - CITES')
            ->setTitle("Impresión de Certificado CITES")
            ->setSubject("CITES")
            ->setDescription("Impresión de Certificado CITES")
            ->setKeywords("CITES")
            ->setCategory("CITES");

        return $excel;
    }

    function generar_reporte(){
        //Crear variables de ambito para reporte excel
        $excel = new Spreadsheet();

        $this->rescal = $this->get_datos_calidad();
        $this->rescam = $this->get_datos_campania();
        $excel = $this->autor_reporte($excel);

        $excel = $this->reporte_general($excel);

        $excel = $this->reporte_especifico($excel);

        $excel = $this->reporte_datos_resultados($excel);

        unset($this->rescal);
        unset($this->rescam);

        //Descarga de reporte excel
        $this->descargar_reporte($excel);
    }

    function descargar_reporte($excel){
        $writer = new Xlsx($excel);
        $nameFile ="ImpresiónCITES_".date('d-m-Y');
        //$writer->save($fxls);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$nameFile.'.xlsx"');
        header('Cache-Control: max-age=0');
        header('Expires: Fri, 11 Nov 2011 11:11:11 GMT');
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $writer->save('php://output');
    }


    function imprimeHoja($item_id){
        global $objCatalog,$objItem;
        /**
         * Datos de la cite
         */
        $objCatalog->conf_catalog_datos_general_print();
        $cataobj = $objCatalog->getCatalogList();
        $item = $objItem->get_item2($item_id);
        $especie = $objItem->get_especie_list($item_id);
        /**
         * si no se encuentra generado code en la tabla, se genera
         */
        if($item["code"]==""){
            $codeSha = sha1(time());
            $rec = array();
            $rec["code"] = $codeSha;
            $where = "itemId=".$item_id;
            $this->dbm->autoExecute($this->tabla["cites"],$rec,"UPDATE",$where);
            $item["code"] = $rec["code"];
        }

        $codeQr = array(
            "code" => $item["code"],
            "id" =>$item_id
        );
        $item["codeQr"] = base64_encode(serialize($codeQr));
        /**
         * ------------------------------------------------------------------------------------------------------
         */
        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //$pdf->SetAutoPageBreak(TRUE, 0);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Cites Bolivia - NO OFICIAL');
        $pdf->SetTitle('Permiso / Certificado CITE');
        $pdf->SetSubject('CITES CERTIFICADO');
        $pdf->SetKeywords('CITES,Bolivia');





        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(0, 0, 0);
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
            $pdf->MultiCell(5, 0, $txt, 0, 'J', 0, 1, '106', '16', true, 0, false, true, 0);
        // Re-Exportación
        if($item["tipo_documento_id"]==2)
            $pdf->MultiCell(5, 0, $txt, 0, 'J', 0, 1, '106', '22', true, 0, false, true, 0);
        // Importación
        if($item["tipo_documento_id"]==3)
            $pdf->MultiCell(5, 0, $txt, 0, 'J', 0, 1, '106', '28', true, 0, false, true, 0);
        // Otro
        if($item["tipo_documento_id"]==4)
            $pdf->MultiCell(5, 0, $txt, 0, 'J', 0, 1, '106', '35', true, 0, false, true, 0);

        /**
         * 2. Vàlido hasta
         */
        //
        //$item["fecha_expiracion"] = '2020-08-01';

        if($item["fecha_expiracion"]!=""){
            $date = new DateTime($item["fecha_expiracion"]);
            $txt = $date->format('d/m/Y');
            $pdf->MultiCell(43, 0, $txt."\n", 0, 'L', 0, 1, '154', '32', true, 0, false, true, 0);
        }

        /**
         * 3. Importador
         */
        $txt =  $item["importador_nombre"]."\n";
        $txt .= $item["importador_direccion"]."\n";
        $pdf->MultiCell(92, 21, $txt, 0, 'L', 0, 1, '12', '45', true, 1, false, true, 21);

        /**
         * 3a País
         */

        $txt = $cataobj["pais"][$item["importacion_pais_id"]];
        $pdf->MultiCell(69, 7, $txt, 0, 'L', 0, 1, '35', '68', true, 1, false, true, 7);

        /**
         * 4. Exportador
         */

        $txt =  $item["exportador_nombre"]."\n";
        $txt .= $item["exportador_direccion"]."\n";
        $txt .= $cataobj["pais"][$item["exportador_pais_id"]]."\n";

        $pdf->MultiCell(92, 21, $txt, 0, 'J', 0, 1, '106', '45', true, 1, false, true, 21);

        /**
         * 5. Condiciones Especiales
         */
        $txt =  $item["condiciones_especiales"];
        $pdf->MultiCell(92, 25, $txt, 0, '', 0, 1, '12', '83', true, 1, false, true, 25);

        /**
         * 6. autoridad adminsitartiva
         */
        /*$txt =  "MINISTERIO DE MEDIO AMBIENTE Y AGUA \n";
        $txt .= "VICEMINISTERIO DE MEDIO AMBIENTE, \n";
        $txt .= "BIODIVERSIDAD, CAMBIOS CLIMÁTICOS \n";
        $txt .= "Y DE GESTIÓN Y DESARROLLO FORESTAL \n";
        $txt .= "Dirección General de Biodiversidad \n";
        $txt .= "y Áreas Protegidas \n";
        $txt .= "Av. Camacho N 1471 \n";
        $txt .= "LA PAZ, BOLIVIA \n";*/
        $txt = $item["autoridad_administrativa"];

        $pdf->MultiCell(53, 38, $txt, 0, 'C', 0, 1, '145', '76', true, 1, false, true, 38);

        /**
         * 5a. Condiciones Especiales.
         */
        //print_struc($cataobj);exit;
        //$txt = $cataobj["tipo_proposito"][$item["proposito_id"]];
        $txt = $cataobj["tipo_proposito"][$item["proposito_id"]];
        //$txt =  "T";
        $pdf->MultiCell(5, 3, $txt, 0, 'L', 0, 1, '51', '113', true, 0, false, true, 0);

        /**
         * 5b. Estampilla de Seguridad
         */
        $txt =  $item["numero_estampilla"];
        $pdf->MultiCell(24, 3, $txt, 0, 'L', 0, 1, '80', '113', true, 0, false, true, 0);



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
                    $y_f = 160;
                    break;
                case 3:
                    $border = 0;
                    $y_f = 175;
                    break;
                case 4:
                    $border = 0;
                    $y_f = 190;
                    break;
                case 5:
                    $border = 0;
                    $y_f = 206;
                    break;
            }
            /**
             * 7/8 Nombre científico y nombre común del animal o planta ( genero /especie )
             */

            $pdf->SetFont('helvetica', '', 8);
            $txt = $row["nombre_comun"];
            $txt = strtoupper($txt);
            //$border = 1;
            $pdf->MultiCell(34, 7, $txt, $border, 'L', 0, 1, '15', $y_f+0, true, 1, false, true, 7);

            $txt = $row["nombre"];
            $pdf->SetFont('helvetica', 'I', 8);
            $pdf->MultiCell(34, 7, $txt, $border, 'L', 0, 1, '15', $y_f+7, true, 1, false, true, 7);
            $pdf->SetFont('helvetica', '', 7);

            /**
             * 9 Descripción de los especímenes
             */
            $txt = $row["descripcion"]."\n";
            $pdf->MultiCell(76, 14, $txt, $border, 'L', 0, 1, '51', $y_f+0, true, 1, false, true, 14);
            /**
             * 10 Apéndice y origen
             */
            $txt = $row["apendice"]." / ".$row["origen"];
            $pdf->MultiCell(12, 5, $txt, $border, 'L', 0, 1, '130', $y_f+0, true, 0, false, true, 0);
            /**
             * 11. Cantidad
             */
            $txt = $row["unidad"];
            $pdf->MultiCell(36, 5, $txt, $border, 'L', 0, 1, '145', $y_f+0, true, 0, false, true, 0);
            /**
             * 11a. Total exportado
             */
            //$txt = "25/100";

            if ($row["cupo_solicitado"] != '0' and $row["cupo_solicitado"] != ""){

                $txt = $row["cupo_solicitado"].' / '.$row["cupo_total"];
            }else{
                $txt = "";
            }
            $pdf->SetFont('helvetica', '', 6);
            $pdf->MultiCell(14, 5, $txt, $border, 'L', 0, 1, '184', $y_f+0, true, 0, false, true, 0);
            $pdf->SetFont('helvetica', '', 7);

            /**
             * 12 a/b País de origen
             */
            $txt = $row["pais"];
            $pdf->MultiCell(37, 5, $txt, $border, 'L', 0, 1, '144', $y_f+8, true, 0, false, true, 0);
            /**
             * Permiso N
             */
            $txt = $row["numero_permiso"];
            $pdf->MultiCell(15, 0, $txt, $border, 'L', 0, 1, '183', $y_f+11, true, 0, false, true, 0);
            /**
             * ------------------------------------------------------------------------------------------------------------------------------------
             */
        }

        /**
         * 13 Este Permiso es emitido por
         */
        $border = 0;

        $txt = $item["emitido_lugar"];
        $pdf->MultiCell(20, 0, $txt, $border, 'C', 0, 1, '19', 234, true, 0, false, true, 0);

        if($item["emitido_fecha"]!=""){
            $date = new DateTime($item["emitido_fecha"]);
            $txt = $date->format('d-m-Y');
            $txt = $objItem->obtenerFechaLiteral($txt);

            //$txt = "";
            $pdf->MultiCell(33, 0, $txt, $border, 'C', 0, 1, '42', 234, true, 0, false, true, 0);
        }
        //$txt = "17 de Octubre de 2012";
        /**
         * 15 Conocimiento de Embarque / Número de guía aéreo
         */
        $border = 0;
        $txt =  $cataobj["puerto_embarque"][$item["puerto_embarque"]];
        $pdf->MultiCell(28, 8, $txt, $border, 'C', 0, 1, '61', 262, true, 1, false, true, 8);

        //$txt = "17 de Octubre de 2012";
        //$pdf->MultiCell(28, 0, $txt, $border, 'C', 0, 1, '93', 265, true, 0, false, true, 0);

        // ---------------------------------------------------------
        /**
         * Generación de datos QR para el certificado
         */
        /*
        print_struc($code);
        $code = unserialize(base64_decode($code));
        print_struc($code);
        exit;
        */
        // new style
        $style = array(
            'border' => false,
            'padding' => 0,
            //'fgcolor' => array(128,0,0),
            'bgcolor' => false
        );
        /*
         * Generamos el url de verificación
         */
        $config = $this->getConfigDomain();
        if( !isset($config["dominio"]) || $config["dominio"]==""){
            echo "<div style='text-align: center;padding: 5px; border: 1px solid #a65656;background: #fff9f9;margin-top: 25px;color:red;font-family: Arial;'><strong>[Error]</strong> Dominio no configurado</div>";
            exit;
        }
        $urlweb = "https://".$config["dominio"]."/ingreso/verifica?code=".$item["codeQr"];
        //echo $urlweb;exit;
        $pdf->setCellPaddings(0,0,0,0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->write2DBarcode($urlweb, 'QRCODE,L', 184, 270, 20, 20, $style, 'B');
        /**
         * Creación del archivo cites
         */
        $pdf->Output('cites.pdf', 'I');
        exit;
    }

    function obtenerFechaLiteral($fecha){
    $num = date("j", strtotime($fecha));
    $anno = date("Y", strtotime($fecha));
    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
    $mes = $mes[(date('m', strtotime($fecha))*1)-1];
    return $num.' de '.$mes.' de '.$anno;

    }

    function getConfigDomain(){
        $sql = "SELECT * FROM cites_core.config AS c WHERE c.activo=1 LIMIT 1";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
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
        //$this->dbm->debug = true;
        $sql = "select CONCAT(e.nombre_comun,' - ',e.nombre) as nombre_especie, e.nombre_comun, e.nombre,
        p.descripcion, a.nombre as apendice, CONCAT(p.cantidad,'  ',u.unidad) as unidad, p1.nombre AS pais
        , o.sigla as origen, p.numero_permiso, p.cupo_solicitado, p.cupo_total
        from ".$this->tabla["especie"]." as p 
        LEFT JOIN ".$this->tabla["c_especie"]." AS e ON e.itemId = p.especie_id
        LEFT JOIN ".$this->tabla["c_apendice"]."  AS a ON a.itemId = p.apendice_id
        LEFT JOIN ".$this->tabla["c_tipo_unidad"]."  AS u ON u.itemId = p.unidad_id
        LEFT JOIN ".$this->tabla["c_pais"]."  AS p1 ON p1.itemId = p.pais_id
        LEFT JOIN ".$this->tabla["c_tipo_origen"]."  AS o ON o.itemId = p.origen_id
        where cites_id='".$item_id."'";
        //print_struc($sql);
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
                LEFT JOIN cites_core.usuario AS u ON u.itemId = e.usuario_id
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
                LEFT JOIN cites_core.usuario AS u ON u.itemId = e.usuario_id
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
                if($item["info_final"]==0){
                    $error = 1;
                    $msg .= "- <strong>INFORMACIÓN FINAL</strong> Tiene que aprobar y guardar la información final.<br>";
                }
                if($item["impreso"]==0){
                    $error = 1;
                    $msg .= "- <strong>INFORMACIÓN FINAL</strong> Confirme la Impresión del Certificado.<br>";
                }
                /**
                 * Control de numeros asignados
                 */
                if($item["numero_asignado"] == 0){
                    $msg .= "- <strong>ASIGNACIÓN NUMERICA</strong>Tiene que realizar la asignación de un número al certificado.<br>";
                }
                /**
                 * Control de regisrtos no revisados y aprogados
                 */
                if($item["especies_aprobadas"] != 0){
                    $msg .= "- <strong>ESPECIES NO APROBADAS</strong> Se aconseja revisar las especies antes de APROBAR.<br>";
                }
                if($item["archivos_aprobados"]!=0){
                    $msg .= "- <strong>REQUISITOS NO APROBADOS</strong> Se aconseja revisar los requisito antes de APROBAR.<br>";
                }
                if($item["pagos_aprobados"]!=0){
                    $msg .= "- <strong>DEPÓSITOS NO APROBADOS</strong> Se aconseja revisar los depósitos antes de APROBAR.<br>";
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