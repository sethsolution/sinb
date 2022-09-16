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

    public function get_item_datatable_Rows($especie_id){
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["aprovechamiento"];
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

        $groupBy = "";
        $having = "";
        /**
         * Resultado de la consulta enviada
         */
        $resultado = $this->get_grilla_datatable_simple($db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having, "right");
        $resultado["recordsTotal"]=$resultado["recordsFiltered"];
        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */

        foreach ($resultado['data'] as $itemId => $valor) {
            if($valor['fecha_reporte'] !="")$resultado['data'][$itemId]['fecha_reporte'] = date_format(date_create($valor['fecha_reporte']),"d/m/Y");
        }

        return $resultado;
    }

    function get_item($idItem){

        $info = '';
        if($idItem!=''){

            $sql = "SELECT
                   i.*
                    FROM ".$this->tabla["aprovechamiento"]." AS i
                    LEFT JOIN ".$this->tabla["c_aprovechamiento_tipo"]." AS ct ON ct.itemId = i.tipo_id
                    WHERE i.itemId =  '".$idItem."'
                    AND i.empresa_id = '" . $this->empresa_id. "'";
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
        $where =  " empresa_id = '" . $this->empresa_id;
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
                , ct.sustitucion_1
                , ct.sustitucion_2
                , ct.sustitucion_3
                , i.sustitucion_cites
                , i.sustitucion_numero
                , i.sustituciones
                , (SELECT SUM(p.monto)  FROM empresa_pago AS p WHERE p.cites_id = i.itemId AND p.empresa_id = i.empresa_id and p.categoria_id=2) AS total_depositado
                , (SELECT SUM(p.monto)  FROM empresa_pago AS p WHERE p.cites_id = i.itemId AND p.empresa_id = i.empresa_id and p.categoria_id=6) AS total_sustitucion_depositado
                , (SELECT COUNT(*)  FROM cites_especie AS e WHERE e.cites_id = i.itemId AND e.empresa_id = i.empresa_id) AS total_especie  ";
        if($all==1){
            $sql .= " , i.* ";
        }

        $sql .= "FROM ".$this->tabla["cites"]." AS i
                LEFT JOIN ".$this->tabla["c_cites_tipo"]." AS ct ON ct.itemId = i.tipo_id
                left join ".$this->tabla["c_estado"]." AS e ON e.itemId = i.estado_id
                WHERE i.itemId =  '".$idItem."'
                AND i.empresa_id = '" . $this->empresa_id. "'";

        $info = $this->dbm->Execute($sql);
        $item = $info->fields;

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

              if($item_id != ""){

                    $rec=array();
                    $rec["estado_id"] = 2;
                    $rec["dateUpdate"] = date("Y-m-d H:i:s");
                    $rec["enviado_fecha"] = date("Y-m-d H:i:s");

                    $where = " empresa_id = '".$this->empresa_id."' and itemId= '".$item_id."' " ;
                    $tabla = $this->tabla["aprovechamiento"];
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
            $res['msg'] = "El reporte que intenta enviar, no existe";
        }
        //return$item;
        return$res;
    }

    /**
     * @param $itemId
     * Imprime
     */
    function imprime2($item_id){
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
        */
        /**
         * ------------------------------------------------------------------------------------------------------
         */

        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Cites Bolivia - NO OFICIAL');
        $pdf->SetTitle('Permiso / Certificado CITE');
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
            $pdf->MultiCell(43, 0, $txt."\n", 0, 'L', 0, 1, '166', '32', true, 0, false, true, 0);
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
        $pdf->MultiCell(92, 25, $txt, 0, 'J', 0, 1, '12', '83', true, 1, false, true, 25);

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
        if (trim($txt)==""){$txt=0;}
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

            $pdf->SetFont('helvetica', '', 9);
            $txt = $row["nombre_comun"];
            $txt = strtoupper($txt);
            //$border = 1;
            $pdf->MultiCell(34, 7, $txt, $border, 'L', 0, 1, '15', $y_f+0, true, 1, false, true, 7);

            $txt = $row["nombre"];
            $pdf->SetFont('helvetica', 'I', 9);
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
            $txt = "";
            $pdf->MultiCell(14, 5, $txt, $border, 'L', 0, 1, '184', $y_f+0, true, 0, false, true, 0);
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

        if($item["aprobado_fecha"]!=""){
            $date = new DateTime($item["aprobado_fecha"]);
            $txt = $date->format('d/m/Y');
            //$txt = "";
            $pdf->MultiCell(30, 0, $txt, $border, 'C', 0, 1, '51', 234, true, 0, false, true, 0);
        }

        /**
         * 15 Conocimiento de Embarque / Número de guía aéreo
         */
        $border = 0;
        $txt =  $cataobj["puerto_embarque"][$item["puerto_embarque"]];
        $pdf->MultiCell(28, 8, $txt, $border, 'C', 0, 1, '61', 262, true, 1, false, true, 8);

        //$txt = "17 de Octubre de 2012";
        $txt = "";
        $pdf->MultiCell(28, 0, $txt, $border, 'C', 0, 1, '93', 265, true, 0, false, true, 0);

// ---------------------------------------------------------

//Close and output PDF document
        $pdf->Output('example_051.pdf', 'I');
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
                    FROM ".$this->tabla["c_cites_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId and a.cites_id= '".$item_id."'
                    AND a.empresa_id = '".$this->empresa_id."'
                    WHERE cr.cites_tipo_id = '".$item1['tipo_id']."'
                    AND r.categoria_id = 2 and a.adjunto_tamano > 0 ";

        $info = $this->dbm->execute($sql);
        $item = $info->getRows();

        return $item;
    }


    function sustitucion_verifica($itemId){
        /**
         * Verificamos la cantidad de cites relacionadas a la cite original
         */
        $sql = "SELECT * FROM cites AS c WHERE c.cites_id ='".$itemId."' ";
        $verifica = $this->dbm->Execute($sql);
        $verifica = $verifica->getRows();

        $rec_sus = array();
        $rec_sus["sustitucion_numero"] = count($verifica) + 1; // El número de sustitución que le corresponde al nuevo cite copiado

        /**
         * Verificamos si los cites sustituidos se encuentran verificados o sustituidos
         * Estado diferente a 4 o 7
         */
        $sql = "SELECT * FROM cites AS c WHERE c.cites_id = '".$itemId."' AND  c.estado_id NOT IN (4,7)";
        $verifica_estado = $this->dbm->Execute($sql);
        $verifica_estado = $verifica_estado->getRows();
        $estado_total = count($verifica_estado);
        $rec_sus["sustituciones_enproceso"] = $estado_total;

        /**
         * Verificamos si existe alguna sustitución en estado aprobado, para cambiar su estado
         */
        $sql = "SELECT * FROM cites AS c WHERE c.cites_id = '".$itemId."' AND  c.estado_id = 4 ";
        $sustitucion_activo = $this->dbm->Execute($sql);
        $sustitucion_activo = $sustitucion_activo->getRows();
        $sustitucion_activo_total = count($sustitucion_activo);
        $rec_sus["sustituciones_activos"] = $sustitucion_activo_total;

        return $rec_sus;
    }
}