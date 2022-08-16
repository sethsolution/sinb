<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:23
 */
use Dompdf\Dompdf;


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
        $img_file = './module/cites/template/images/pdf/dispensacion_certificado.jpg';
        $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
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
        //print_struc($this);exit();
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
        $extraWhere = " empresa_id= '".$this->empresa_id."' ";
        if($especie_id !=""){
            $extraWhere .= " and i.itemId IN ( SELECT ii.dispensacion_id FROM dispensacion_especie AS ii WHERE ii.especie_id= '".$especie_id."' ) ";
        }
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

            $sql = "SELECT
                    ct.nombre AS dispensacion_tipo
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
                    FROM ".$this->tabla["dispensacion"]." AS i
                    LEFT JOIN ".$this->tabla["c_dispensacion_tipo"]." AS ct ON ct.itemId = i.tipo_id
                    left join ".$this->tabla["c_estado"]." AS e ON e.itemId = i.estado_id
                    LEFT JOIN ".$this->tabla["c_pais"]." AS p1 ON p1.itemId = i.importacion_pais_id
                    LEFT JOIN ".$this->tabla["c_pais"]." AS p2 ON p2.itemId = i.exportador_pais_id
                    LEFT JOIN ".$this->tabla["c_tipo_documento"]." AS d ON d.itemId = i.tipo_documento_id
                    LEFT JOIN ".$this->tabla["c_tipo_proposito"]." AS pr ON pr.itemId = i.proposito_id
                    LEFT JOIN ".$this->tabla["sustitucion"]." AS s ON s.dispensacion_id_sustitucion = ".$idItem."
                    LEFT JOIN ".$this->tabla["c_sustitucion_tipo"]." AS st ON st.itemId =  s.tipo_id

                    WHERE i.itemId =  '".$idItem."'
                    AND i.empresa_id = '" . $this->empresa_id. "'";

            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        if($info["sustitucion_dispensacion"]==1){
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
     * Borrar un registro de la base de datos
     */
    function item_delete($id){
        /**
         * borramos a los hijos antes de borrar al principal
         */
        $campo_id="itemId";
        $where =  " empresa_id = '" . $this->empresa_id;
        $res = $this->item_delete_sbm($id,$campo_id,$this->tabla["dispensacion"], $where);
        return $res;
    }
    /**
     * Get Resumen
     */
    function get_resumen($idItem,$all=0){

        $sql = "SELECT
                ct.nombre AS dispensacion_tipo
                , e.nombre as estado
                , ct.monto AS monto
                , ct.sustitucion_1
                , ct.sustitucion_2
                , ct.sustitucion_3
                , i.sustitucion_dispensacion
                , i.sustitucion_numero
                , i.sustituciones

                , (SELECT SUM(p.monto)  FROM empresa_pago AS p WHERE p.dispensacion_id = i.itemId AND p.empresa_id = i.empresa_id) AS total_depositado
                , (SELECT COUNT(*)  FROM dispensacion_especie AS e WHERE e.dispensacion_id = i.itemId AND e.empresa_id = i.empresa_id) AS total_especie  ";
        if($all==1){
            $sql .= " , i.* ";
        }
        $sql .= "FROM ".$this->tabla["dispensacion"]." AS i
                LEFT JOIN ".$this->tabla["c_dispensacion_tipo"]." AS ct ON ct.itemId = i.tipo_id
                left join ".$this->tabla["c_estado"]." AS e ON e.itemId = i.estado_id
                WHERE i.itemId =  '".$idItem."'
                AND i.empresa_id = '" . $this->empresa_id. "'";

        $info = $this->dbm->Execute($sql);
        $item = $info->fields;
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


        //$dato["desembolsado"] = round($info["monto"],2);

        /**
         * Sustitución
         */
        if($item["sustitucion_dispensacion"]==1) {
            /**
             * Sacamos el monto que debe pagar por la sustitución
             */
            switch ($item["sustitucion_numero"]) {
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
        }

        return $item;

    }


    function get_sustitucion_requisito($tipo_id,$itemId){
        $sql = "SELECT 
                    count(*) as total
                    FROM ".$this->tabla["c_sustitucion_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["sustitucion_archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId and a.sustitucion_id= '".$itemId."'
                    AND a.empresa_id = '".$this->empresa_id."'
                    WHERE cr.sustitucion_tipo_id = '".$tipo_id."'
                    AND r.categoria_id = 7
                    and r.activo = 1
                    AND r.requerido = 1
                    AND a.adjunto_tamano IS null
                    ";
        $info = $this->dbm->execute($sql);
        $item = $info->fields;
        return $item["total"];
    }


    /**
     * Get ENVIAR
     */
    function enviar($item_id){
        $item = $this->get_resumen($item_id,1);

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
                if($item["requisitos_datos"]==0){
                    $error = 1;
                    $msg .= "- <strong>PASO 3 - No Guardo los datos adicionales.</strong> Tiene que registrar los datos adicionales.  <br>";
                }
                /**
                 * Revisamos si existe algun documento requerido que no haya sido cargado
                 */
                $requisitos_sin_cargados = $this->get_requisito_sin_cargado($item['itemId'],$item['tipo_id']);
                if ($requisitos_sin_cargados!=0){
                    $error = 1;
                    $msg .= "- <strong>PASO 3 - Cargue todos los documentos obligatorios.</strong> Revise los requisitos. <br>";
                }

                if($item["sustitucion_dispensacion"]==1){
                    $sql = "select * from ".$this->tabla["sustitucion"]." where dispensacion_id_sustitucion= '".$item_id."'  and empresa_id= '".$this->empresa_id."' ";
                    $info = $this->dbm->Execute($sql);
                    $info = $info->fields;

                    /**
                     * Verificamos los requisitos para sustitución
                     */
                    $sustitucion_sin_requisito =$this->get_sustitucion_requisito($info["tipo_id"],$info["itemId"]);
                    if ($sustitucion_sin_requisito!=0){
                        $error = 1;
                        $msg .= "- <strong>SUSTITUCIÓN - Cargue todos los documentos obligatorios.</strong> Revise los requisitos . <br>";
                    }
                    /**
                     * Verificamos los datos totales para el deposito
                     */
                    if($item["total_sustitucion_depositado"]<$item["monto_sustitucion"]){
                        $error = 1;
                        $msg .= "- <strong>SUSTITUCIÓN - El monto depositado es menor al monto a depositar.</strong> Registra boletas de deposito.  <br>";
                    }
                }else{
                    if($item["total_depositado"]<$item["total_depositar"]){
                        $error = 1;
                        $msg .= "- <strong>PASO 4 - El monto depositado es menor al monto a depositar.</strong> Registra boletas de deposito.  <br>";
                    }
                }


                if($error ==0){
                    $rec=array();
                    $rec["estado_id"] = 2;
                    $rec["dateUpdate"] = date("Y-m-d H:i:s");
                    $rec["enviado_fecha"] = date("Y-m-d H:i:s");

                    $where = " empresa_id = '".$this->empresa_id."' and itemId= '".$item_id."' " ;
                    $tabla = $this->tabla["dispensacion"];
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
                $res['msg'] = "No se puede cambiar de estado a esta dispensación";
            }

        }else{
            $res['res'] = 2;
            $res['msg'] = "La Dispensación que intenta enviar, no existe";
        }
        return $res;
    }

    public function get_requisito_sin_cargado($itemId, $tipo_id){

        $sql = "SELECT 
        count(*) as cargados
        
        FROM ".$this->tabla["c_dispensacion_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId and a.dispensacion_id= '".$itemId."'
                    AND a.empresa_id = '".$this->empresa_id."'
                    WHERE cr.dispensacion_tipo_id = '".$tipo_id."'
                    AND r.requerido = 1
                    AND a.adjunto_tamano IS null";

        $info = $this->dbm->execute($sql);
        $item = $info->fields;
        return $item["cargados"];
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
        where p.empresa_id = '" . $this->empresa_id. "' and dispensacion_id='".$item_id."'";
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

            /*$txt = $row["nombre_especie"];
            $pdf->MultiCell(44, 14, $txt, $border, 'L', 0, 1, '12', $y_f+0, true, 1, false, true, 14);
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
            /**
             * ------------------------------------------------------------------------------------------------------------------------------------
             */
        }

        /**
         * 13 Este Permiso es emitido por
         */
        $border = 0;

        //$txt = "La Paz";
        $txt = $item["emitido_lugar"];
        $pdf->MultiCell(40, 0, $txt, $border, 'C', 0, 1, '50', 260, true, 0, false, true, 0);
        $txt = $cataobj["puerto_embarque"][$item["puerto_embarque"]];
        $pdf->MultiCell(40, 0, $txt, $border, 'C', 0, 1, '50', 263, true, 0, false, true, 0);

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
     * SUSTITUCION DISPENSNACION
     */

    function sustitucion_verifica($itemId){
        /**
         * Verificamos la cantidad de dispensacion relacionadas al certificado original
         */
        $sql = "SELECT * FROM dispensacion AS c WHERE c.dispensacion_id ='".$itemId."' ";
        $verifica = $this->dbm->Execute($sql);
        $verifica = $verifica->getRows();

        $rec_sus = array();
        $rec_sus["sustitucion_numero"] = count($verifica) + 1; // El número de sustitución que le corresponde al nuevo cite copiado

        /**
         * Verificamos si los certificados sustituidos se encuentran verificados o sustituidos
         * Estado diferente a 4 o 7
         */
        $sql = "SELECT * FROM dispensacion AS c WHERE c.dispensacion_id = '".$itemId."' AND  c.estado_id NOT IN (4,7)";
        $verifica_estado = $this->dbm->Execute($sql);
        $verifica_estado = $verifica_estado->getRows();
        $estado_total = count($verifica_estado);
        $rec_sus["sustituciones_enproceso"] = $estado_total;

        /**
         * Verificamos si existe alguna sustitución en estado aprobado, para cambiar su estado
         */
        $sql = "SELECT * FROM dispensacion AS c WHERE c.dispensacion_id = '".$itemId."' AND  c.estado_id = 4 ";
        $sustitucion_activo = $this->dbm->Execute($sql);
        $sustitucion_activo = $sustitucion_activo->getRows();
        $sustitucion_activo_total = count($sustitucion_activo);
        $rec_sus["sustituciones_activos"] = $sustitucion_activo_total;

        return $rec_sus;
    }

    function item_update($rec,$itemId,$que_form,$accion="new"){
        /**
         * Sacamos los datos del item para su verificación
         */
        $item = $this->get_item($itemId);

        /**
         * solo procesa la información si el estado de la solicitud esta aprobada o sustituido.
         */

        if($item["estado_id"]==4 or $item["estado_id"]==7) {

            /**
             * Sacamos datos de verificación de sustitución
             */
            $sustitucion_verifica = $this->sustitucion_verifica($itemId);
            /**
             * Solo dejara realizar la creación de uns sustitución,
             * si las otras sustituciones estan aprobadas.
             */
            if($sustitucion_verifica["sustitucion_numero"]>=4 ){
                $res["res"] = 2;
                $res["msg"] = "El certificado ya contiene 3 Sustituciónes. Ya no puede realizar más sustituciones para este certificado de DISPENSACIÓN";
                $res['accion'] = $accion;

            }else if ($sustitucion_verifica["sustituciones_enproceso"]==0 ){

                /**
                 * Cambiamos de estado activo a sustituido, a los anteriores Certificados de sustitución
                 * que se encuentren activos
                 */
                $rec_cambia = array();
                $rec_cambia["estado_id"] = 7;
                $where ="dispensacion_id='".$itemId."' and estado_id=4 ";
                //$this->dbm->debug = true;
                $this->dbm->AutoExecute($this->tabla["dispensacion"],$rec_cambia,"UPDATE",$where);

                /**
                 * preprocesamos los datos
                 */
                if (isset($rec["itemId"])) unset($rec["itemId"]);
                $respuesta_procesa = $this->procesa_datos($que_form, $rec, $item, $accion);


                /**
                 * Sacamos los datos de archivo y especies de DISPENSACION
                 */
                $sql  = "SELECT * FROM dispensacion_archivo AS a WHERE a.dispensacion_id='".$itemId."' ";
                $archivo = $this->dbm->Execute($sql);
                $archivo = $archivo->getRows();

                $sql  = "SELECT * FROM dispensacion_especie AS a WHERE a.dispensacion_id='".$itemId."' ";
                $especie = $this->dbm->Execute($sql);
                $especie = $especie->getRows();

                /**
                 * Creamos un nuevo dispensacion copia del original, que sera para la sustitución
                 */
                $rec_new = $item;
                $rec_new["sustitucion_dispensacion"] = 1;
                $rec_new["dispensacion_id"] = $itemId;
                $rec_new["dateUpdate"]=$respuesta_procesa["dateUpdate"];
                $rec_new["dateCreate"]=$respuesta_procesa["dateCreate"];
                $rec_new["userUpdate"]=$respuesta_procesa["userUpdate"];
                $rec_new["userCreate"]=$respuesta_procesa["userCreate"];
                $rec_new["sustitucion_numero"]= $sustitucion_verifica["sustitucion_numero"];

                $rec_new["empresa_id"] = $this->empresa_id;
                $rec_new["estado_id"] = 1;
                $codigo = $this->get_ramdom_string(10);
                $rec_new["codigo_qr_verificacion"] = $codigo;

                unset($rec_new["itemId"]);
                unset($rec_new["userUpdate_nucleo"]);
                unset($rec_new["dateUpdate_nucleo"]);
                //unset($rec_new["numero"]);
                unset($rec_new["aprobado_user"]);
                unset($rec_new["aprobado_fecha"]);
                unset($rec_new["requisitos_fecha"]);
                unset($rec_new["requisitos_observacion"]);
                unset($rec_new["requisitos_observado"]);
                unset($rec_new["observacion_texto_fecha"]);
                unset($rec_new["observacion_user"]);
                unset($rec_new["observacion_fecha"]);
                unset($rec_new["observacion"]);
                unset($rec_new["observado"]);
                unset($rec_new["codigo_qr_contador"]);
                $campo_id = "itemId";
                $where = "empresa_id = '" . $this->empresa_id . "'";
                $res = $this->item_update_sbm("", $rec_new, $this->tabla["dispensacion"], "new", $campo_id, $where);
                $res["accion"] = $accion;

                $sustitucion_dispensacion_id =  $res["id"];
                /**
                 * Llenamos la base de archivos
                 */
                foreach ($especie as $row){
                    $save = $row;
                    $save["id_referencia"] =$row["itemId"];
                    $save["dispensacion_id"] =$sustitucion_dispensacion_id;
                    $save["dateUpdate"]=$respuesta_procesa["dateUpdate"];
                    $save["dateCreate"]=$respuesta_procesa["dateCreate"];
                    $save["userUpdate"]=$respuesta_procesa["userUpdate"];
                    $save["userCreate"]=$respuesta_procesa["userCreate"];
                    unset($save["userUpdate_nucleo"]);
                    unset($save["dateUpdate_nucleo"]);
                    unset($save["dateUpdate_nucleo"]);
                    unset($save["itemId"]);
                    $resp = $this->item_update_sbm("", $save, $this->tabla["especie"], "new", $campo_id, $where);
                }

                /**
                 * Llenamos la base de especies
                 */
                foreach ($archivo as $row){
                    $save = $row;
                    $save["id_referencia"] =$row["itemId"];
                    $save["dispensacion_id"] =$sustitucion_dispensacion_id;
                    $save["dateUpdate"]=$respuesta_procesa["dateUpdate"];
                    $save["dateCreate"]=$respuesta_procesa["dateCreate"];
                    $save["userUpdate"]=$respuesta_procesa["userUpdate"];
                    $save["userCreate"]=$respuesta_procesa["userCreate"];

                    unset($save["userUpdate_nucleo"]);
                    unset($save["dateUpdate_nucleo"]);
                    unset($save["dateUpdate_nucleo"]);
                    unset($save["itemId"]);
                    $resp = $this->item_update_sbm("", $save, $this->tabla["archivo"], "new", $campo_id, $where);
                }

                /**
                 * Le damos el ID de la nueva ficha dispensacion generada
                 */
                $respuesta_procesa["dispensacion_id_sustitucion"]=$sustitucion_dispensacion_id;
                $respuesta_procesa["sustitucion_numero"]=$sustitucion_verifica["sustitucion_numero"];

                /**
                 * Guardo los datos ya procesados
                 */
                $campo_id = "itemId";
                $where = "empresa_id = '" . $this->empresa_id . "'";
                $res = $this->item_update_sbm($itemId, $respuesta_procesa, $this->tabla["sustitucion"], $accion, $campo_id, $where);
                $res["accion"] = $accion;
                /**
                 * Una vez generado el registro de sustitución
                 * se registra los requerimientos dependiendo el tipo
                 */
                $requisito = $this->get_requisito($res["id"],$respuesta_procesa["tipo_id"]);

                /**
                 * Realizamos el cambio de estado estado de DISPENSAION que se va a realizar la sustitución
                 */
                $rec = array();
                $rec["estado_id"] = 7;
                $rec["dateUpdate"]=$respuesta_procesa["dateUpdate"];
                $tabla = $this->tabla["dispensacion"];
                $where = "itemId='".$itemId."'";
                $this->dbm->autoExecute($tabla,$rec,'UPDATE',$where);

                $res["id"] = $sustitucion_dispensacion_id;
            }else{
                $res["res"] = 2;
                $res["msg"] = "El certificado contiene sustituciones en proceso no verificados.";
                $res['accion'] = $accion;
            }

        }else if($item["itemId"]=="" ){
            $res["res"] = 2;
            $res["msg"] = "El certificado no existe";
            $res['accion'] = $accion;
        }else{
            $res["res"] = 2;
            $res["msg"] = "El certificado tiene que estar en un estado validado";
            $res['accion'] = $accion;
        }

        return $res;
    }


    public function get_requisito_list($tipo_id,$item_id){

        $sql = "SELECT 
                    a.*
                    , cr.itemId AS tipo_requisito_id
                    , r.nombre AS nombre_requisito
                    , r.caducidad
                    , r.requerido
                    , r.categoria_id
                    , r.indice
                    FROM ".$this->tabla["c_sustitucion_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["sustitucion_archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId and a.sustitucion_id= '".$item_id."'
                    AND a.empresa_id = '".$this->empresa_id."'
                    WHERE cr.sustitucion_tipo_id = '".$tipo_id."'
                    AND r.categoria_id = 7
                    and r.activo = 1
                    ";
        //print_struc($sql);
        $info = $this->dbm->execute($sql);
        $item = $info->getRows();
        return $item;
    }
    public function get_requisito($item_id,$tipo_id){

        $item = $this->get_requisito_list($tipo_id,$item_id);

        $creo = 0;

        foreach ($item as $row){
            if($row["itemId"] =="" and $row["tipo_requisito_id"]!=""){
                /**
                 * Si no existe el registro en la tabla empresa_archivo, crearemos uno
                 */

                $rec = array();
                $rec["dateCreate"] = $rec["dateUpdate"] =  date("Y-m-d H:i:s");
                $rec["userCreate"] = $rec["userUpdate"] = $this->userId;
                $rec["tipo_requisito_id"] = $row["tipo_requisito_id"];
                $rec["nombre"] = $row["nombre_requisito"];
                $rec["empresa_id"] = $this->empresa_id;
                $rec["sustitucion_id"] = $item_id;
                $rec["estado_id"] = 1;
                $this->dbm->autoExecute($this->tabla["sustitucion_archivo"],$rec);
                $creo = 1;
            }
        }
        if($creo){
            $item = $this->get_requisito_list($tipo_id,$item_id);
        }
        return $item;
    }


    function procesa_datos($que_form,$rec,$item,$accion="new"){

        $dato_resultado = array();
        switch($que_form){
            case 'general':
                /**
                 * $rec = es el arreglo de datos que proviene del formulario, desde el frontend
                 * $$this->item_form = es el arreglo de configuraciòn de datos que se procesaran
                 * $accion = new, update
                 */
                $dato_resultado = $this->procesa_campos_sbm($rec,$this->campos[$que_form],$accion);
                /**
                 * Procesos Adicionales al momento de guardar los datos
                 */
                if ($dato_resultado["tipo_id"]!=4){
                    unset($dato_resultado["causal_id"]);
                }

                $dato_resultado["empresa_id"] = $this->empresa_id;
                $dato_resultado["estado_id"] = 1;
                $dato_resultado["fecha"] = date("Y-m-d");
                $dato_resultado["dispensacion_id"] = $item["itemId"];
                //print_struc($item);
                break;
            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }
}