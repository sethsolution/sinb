<?PHP
namespace App\Vicuna\Module\Esquila\Snippet\Index;
use Core\CoreResources;
use Dompdf\Dompdf;
use Dompdf\Options;

class Index extends CoreResources {
    var $objTable = "esquila";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }
    function getItem($idItem){

        $info = '';

        if($idItem!=''){
            $sqlSelect = ' i.*
                           , concat(u1.name,\' \',u1.last_name) AS user_creater
                            , CONCAT(u2.name,\' \',u2.last_name) as user_updater';
            $sqlFrom = ' '.$this->table[$this->objTable].' i
                         LEFT JOIN '.$this->table_core["user"].' u1 on u1.id=i.user_create
                         LEFT JOIN '.$this->table_core["user"].' u2 on u2.id=i.user_update';
            $sqlWhere = ' i.id='.$idItem;
            $sqlGroup = ' ';

            $sql = 'SELECT '.$sqlSelect.'
                  FROM '.$sqlFrom.'
                  WHERE '.$sqlWhere.'
                  '.$sqlGroup;
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        return $info;
    }


    public function getItemDatatableRows(){
        global $dbSetting;
        $table = $this->table[$this->objTable];
        $primaryKey = 'id';
        $grid = "item";
        $db=$dbSetting[0];
        /**
         * Additional configuration
         */
        $extraWhere = "";
        $groupBy = "";
        $having = "";
        /**
         * Result of the query sent
         */
        $result = $this->getGridDatatableSimple($db,$grid,$table, $primaryKey, $extraWhere);
        foreach ($result['data'] as $itemId => $valor) {
            if(isset($result['data'][$itemId]['fecha_captura'])) $result['data'][$itemId]['fecha_captura'] = $this->changeDataFormat($result['data'][$itemId]['fecha_captura'],"d/m/Y");

            $result['data'][$itemId]['created_at'] = $this->changeDataFormat($result['data'][$itemId]['created_at'],"d/m/Y H:i:s");
            $result['data'][$itemId]['updated_at'] = $this->changeDataFormat($result['data'][$itemId]['updated_at'],"d/m/Y H:i:s");

        }
        return $result;
    }

    /**
     * Index::deleteData($id)
     *
     * Delete a record from the database
     *
     * @param $id
     * @return mixed
     */
    function deleteData($id){
        $field_id="id";
        $res = $this->deleteItem($id,$field_id,$this->table[$this->objTable]);
        return $res;
    }
    function pdf($item_id){
        global $smarty;
        @set_time_limit(0);
        ini_set('memory_limit','800M');
        /**
         * -------------------------------------------------------------------------------------
         * Sacamos el path del directorio donde se realiza la llamada a los archivos
         */
        $path = dirname(__FILE__);
        $path_print = $path."/view/pdf";
        $path_print = str_replace("\\","/",$path_print); // Para windows
        $smarty->assign('path_print', $path_print);

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
        //$options->setDebugPng(TRUE);
        /**/
        $log = $_SERVER['DOCUMENT_ROOT']."/log.html";
        //$options->setLogOutputFile($log);
        /**/


        $pdf = new DOMPDF($options);

        $nombre_archivo = date("Ymd_His_").'- Proyecto ID-'.$item_id.'.pdf';
        /**
         * Datos del usuario
         */
        $smarty->assign('usuario', $_SESSION["userv"]);
        $dateprint =  date("d-m-Y H:i:s");
        $smarty->assign('dateprint', $dateprint);
        /**
         * --------------------------------------------------------
         */

        $item = $this->getItem($item_id);
        $item["comentario"] = $this->cleanHtml($item["comentario"]);
        $item["comentario_observaciones"] = $this->cleanHtml($item["comentario_observaciones"]);
        $item["cupo"] =  $this->getCupos($item_id);
        $item["inscripcion"] =  $this->getInscripciones($item_id);
        $item["codigo_actividad"] =  $this->getActividades($item_id);
        $item["adjunto"] =  $this->getAdjuntos($item_id);
//        print_struc($item);exit;
        $smarty->assign('item', $item);

        /**
         * --------------------------------------------------------
         */

        /**
         * Sacamos los datos del template de impresión del pdf
         */
        $webTemplate = $path_print."/index.tpl";
        //$html = $smarty->fetch($webm["item_print_index"]);
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
    public function getCupos($idItem){

        $itemCupo = '';
        if($idItem!=''){
            $sqlSelect = ' c.gestion_id, c.cupos_autorizado, c.cupos_utilizado, c.descripcion';
            $sqlFrom = ' '.$this->table["institucion_cupo"].' c';
            $sqlWhere = ' c.institucion_id='.$idItem;
            $sqlGroup = ' ';

            $sql = 'SELECT '.$sqlSelect.'
                  FROM '.$sqlFrom.'
                  WHERE '.$sqlWhere.'
                  '.$sqlGroup;
            $itemCupo = $this->dbm->Execute($sql);
            $itemCupo = $itemCupo->getRows();
        }
        return $itemCupo;
    }

    public function getInscripciones($idItem){

        $itemInscripcion = '';

        if($idItem!=''){
            $sqlSelect = ' i.fecha_inscripcion, i.fecha_expiracion, i.descripcion';
            $sqlFrom = ' '.$this->table["institucion_inscripcion"].' i';
            $sqlWhere = ' i.institucion_id='.$idItem;
            $sqlGroup = ' ';

            $sql = 'SELECT '.$sqlSelect.'
                  FROM '.$sqlFrom.'
                  WHERE '.$sqlWhere.'
                  '.$sqlGroup;

            $itemInscripcion = $this->dbm->Execute($sql);
            $itemInscripcion = $itemInscripcion->getRows();
        }
        return $itemInscripcion;
    }

    public function getActividades($idItem){

        $itemActividad = '';

        if($idItem!=''){
            $sqlSelect = 'la.codigo';
            $sqlFrom = ' '.$this->table["institucion_actividad"].' ia
            LEFT JOIN catalogo.lagarto_actividad la on la.id=ia.actividad_id';
            $sqlWhere = ' ia.institucion_id='.$idItem;
            $sqlGroup = ' ';
            $sql = 'SELECT '.$sqlSelect.'
                  FROM '.$sqlFrom.'
                  WHERE '.$sqlWhere.'
                  '.$sqlGroup;
            $itemActividad = $this->dbm->Execute($sql);
            $itemActividad = $itemActividad->getRows();
        }
        return $itemActividad;
    }
    public function getAdjuntos($idItem){

        $itemAdjunto = '';

        if($idItem!=''){
            $sqlSelect = 'ia.attached_name, ia.attached_extension, ia.attached_size, ia.attached_type, descripcion';
            $sqlFrom = ' '.$this->table["institucion_archivo"].' ia';
            $sqlWhere = ' ia.institucion_id='.$idItem;
            $sqlGroup = ' ';
            $sql = 'SELECT '.$sqlSelect.'
                  FROM '.$sqlFrom.'
                  WHERE '.$sqlWhere.'
                  '.$sqlGroup;
            $itemAdjunto = $this->dbm->Execute($sql);
            $itemAdjunto = $itemAdjunto->getRows();
        }
        return $itemAdjunto;
    }

    public function cleanHtml($str){
        /*
        $str = str_replace('\r','',$str);
        $str = str_replace('\n','',$str);
        */
        //$str = preg_replace("/[\r\n|\n|\r]+/", PHP_EOL, $str);
        $str = trim(preg_replace('/\s+/', ' ', $str));

        $str = preg_replace('/(<[^>]+) _msthash=".*?"/i', '$1', $str);
        $str = preg_replace('/(<[^>]+) _msttexthash=".*?"/i', '$1', $str);
        $str = preg_replace('/(<[^>]+) _istranslated=".*?"/i', '$1', $str);
        $str = preg_replace('/(<[^>]+) class=".*?"/i', '$1', $str);
        $str = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $str);
        $str = preg_replace('/(<[^>]+) lang=".*?"/i', '$1', $str);

        $str = preg_replace('/<!--(.*)-->/Uis', '', $str);
        $str = preg_replace('/(?=<!--)([\s\S]*?-->)/', '', $str);
        $str = preg_replace('/(<!--[\s\S]*?-->)/', '', $str);
        //$str = preg_replace('/( )*<!--((.*)|[^<]*|[^!]*|[^-]*|[^>]*)-->\n*/g', '', $str);


        $str = str_replace('&nbsp;&nbsp;','',$str);
        $str = str_replace('<b></b>','',$str);
        $str = str_replace('<p>','',$str);
        $str = str_replace('</p>','<br>',$str);
        $str = str_replace('<o:p>','',$str);
        $str = str_replace('</o:p>','<br>',$str);

        $str = str_replace("<br> <br>",'<br>',$str);
        $str = str_replace('<br><br>','<br>',$str);

        //$str = strip_tags($str);
        return $str;
    }

}