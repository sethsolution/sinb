<?PHP
namespace App\Icas\InstitucionContraparte\Index;
use Core\CoreResources;
use Dompdf\Dompdf;
use Dompdf\Options;

class Index extends CoreResources {
    var $objTable = "institucion";
    var $folder = "institucion_contraparte";
    var $fkey_field = "tipo_id";
    var $extraWhere = "";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
        $this->extraWhere = $this->fkey_field."='2' " ;
    }
    function getItem($idItem){

        $info = '';

        if($idItem!=''){
            $sqlSelect = ' i.*, iit.nombre as tipo, p.nombre as pais, d.name as nombre_departamento
                           , concat(u1.name,\' \',u1.last_name) AS user_creater
                            , CONCAT(u2.name,\' \',u2.last_name) as user_updater';
            $sqlFrom = ' '.$this->table[$this->objTable].' i
                         LEFT JOIN '.$this->table_core["user"].' u1 on u1.id=i.user_create
                         LEFT JOIN '.$this->table_core["user"].' u2 on u2.id=i.user_update
                         LEFT JOIN '.$this->table["icas_institucion_tipo"].' iit on iit.id=i.tipo_id
                         LEFT JOIN '.$this->table["pais"].' p on p.id=i.pais_id
                         LEFT JOIN '.$this->table["departamento"].' d on d.id=i.departamento_id';
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
        $extraWhere = $this->extraWhere;
        $groupBy = "";
        $having = "";
        /**
         * Result of the query sent
         */
        $result = $this->getGridDatatableSimple($db,$grid,$table, $primaryKey, $extraWhere);
        foreach ($result['data'] as $itemId => $valor) {
            if(isset($result['data'][$itemId]['fecha_inicio'])) $result['data'][$itemId]['fecha_inicio'] = $this->changeDataFormat($result['data'][$itemId]['fecha_inicio'],"d/m/Y");
            if(isset($result['data'][$itemId]['fecha_conclusion'])) $result['data'][$itemId]['fecha_conclusion'] = $this->changeDataFormat($result['data'][$itemId]['fecha_conclusion'],"d/m/Y");


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
        $where = $this->extraWhere;
        $res = $this->deleteItem($id,$field_id,$this->table[$this->objTable], $where);
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
         * Sacamos el path para las imágenes y colocarlo en CHROOT
         */
        //$path_image= dirname(__FILE__,5);
        //$path_image= dirname(__FILE__,8);
        //$path_image = str_replace("\\","/",$path_image);
        //echo $path_image;exit;
        //$path_image = $path_image."/template/images/";
        $tmp = sys_get_temp_dir();
        //echo $tmp;exit;

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
        //$item["comentario"] = $this->cleanHtml($item["comentario"]);
        //$item["comentario_observaciones"] = $this->cleanHtml($item["comentario_observaciones"]);
        //$item["cupo"] =  $this->getInstitucionTipo($item["tipo_id"]);
        //print_struc($item);exit;
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