<?php
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
        //print_struc($this);exit();
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["precinto"];
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
        $resultado = $this->get_grilla_datatable_simple($db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having);
        $resultado["recordsTotal"]=$resultado["recordsFiltered"];
        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */
        return $resultado;
    }

    function get_item($idItem){
        $info = '';
        if($idItem!=''){

            $sql = "SELECT
            ct.nombre AS precinto_tipo
            ,e.nombre as estado
            ,i.*
            FROM ".$this->tabla["precinto"]." AS i
            LEFT JOIN ".$this->tabla["c_precinto_tipo"]." AS ct ON ct.itemId = i.tipo_id
            left join ".$this->tabla["c_estado"]." AS e ON e.itemId = i.estado_id
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
        $res = $this->item_delete_sbm($id,$campo_id,$this->tabla["precinto"], $where);
        return $res;
    }

    /**
     * Get Resumen
     */
    function get_resumen($idItem,$all=0){
        $sql = "SELECT SUM(p.cantidad) as cantidad 
                FROM ".$this->tabla["precinto"]." AS p WHERE p.empresa_id = '" . $this->empresa_id. "' AND p.estado_id = 4 ";
        $info = $this->dbm->Execute($sql);
        $item = $info->fields;
        return $item;
    }
    /**
     * Get Enviar
     */
    function enviar($item_id){
        $item = $this->get_item($item_id);

        if(isset($item["itemId"]) and  $item["itemId"]!="" ){
            /**
             * Solo podra cambiar de estado si el estado actual se encuentra en
             * registrado u observado
             */
            if($item["estado_id"] == 1 or $item["estado_id"] == 3){
                $error = 0;
                $msg = "";

                /**
                 * Revisamos si existe algun documento requerido que no haya sido cargado
                 */
                $requisitos_sin_cargados = $this->get_requisito_sin_cargado($item['itemId'], $item['tipo_id']);
                if ($requisitos_sin_cargados!=0){
                    $error = 1;
                    $msg .= "- <strong>Cargue todos los documentos obligatorios.</strong> Revise los requisitos. <br>";
                }
                if($item["requisitos_datos"]==0){
                    $error = 1;
                    $msg .= "- <strong>No Guardo los datos adicionales.</strong> Tiene que registrar los datos adicionales.  <br>";
                }

                if($error ==0){
                    $rec=array();
                    $rec["estado_id"] = 2;
                    $rec["dateUpdate"] = date("Y-m-d H:i:s");
                    $rec["enviado_fecha"] = date("Y-m-d H:i:s");

                    $where = " empresa_id = '".$this->empresa_id."' and itemId= '".$item_id."' " ;
                    $tabla = $this->tabla["precinto"];
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
        return$res;
    }

    public function get_requisito_sin_cargado($itemId, $tipo_id){

        $sql = "SELECT 
                    count(*) as cargados
                    FROM ".$this->tabla["c_precinto_tipo_requisito"]." AS cr 
                    LEFT JOIN ".$this->tabla["c_requisito"]." AS r ON r.itemId = cr.requisito_id
                    left  JOIN ".$this->tabla["archivo"]." AS a ON  a.tipo_requisito_id = cr.itemId and a.precinto_id= '".$itemId."'
                    AND a.empresa_id = '".$this->empresa_id."'
                    WHERE cr.precinto_tipo_id = '".$tipo_id."'
                    AND r.requerido = 1
                    AND a.adjunto_tamano IS null";

        $info = $this->dbm->execute($sql);
        $item = $info->fields;
        return $item["cargados"];
    }

    /**
     * param $itemId
     * Imprime
     */
    function imprime($item_id){
        global $smarty,$webm;
        @set_time_limit(0);
        ini_set('memory_limit','800M');
        /**
         * -------------------------------------------------------------------------------------
         * Sacamos el path del directorio donde se realiza la llamada a los archivos
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
}