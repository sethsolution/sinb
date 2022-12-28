<?PHP
namespace App\Lagarto\Institucion\General;
use Core\CoreResources;

class Index extends CoreResources
{
    var $objTable = "institucion";
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
    function updateData($rec,$itemId,$action){
        //print_struc($rec);exit;
        $form="module";
        $itemData  = $this->processData($form,$rec,$action);
        /**
         * Save processed data
         */
        $field_id="id";
        $res = $this->updateItem($itemId,$itemData ,$this->table[$this->objTable],$action,$field_id);
        $res["accion"] = $action;

        if( $res["res"]==1){
            /**
             * Realizaremos los cálculos correspondientes de la fecha para los datos de la institucion
             */
            $this->setFechasInscripcionExpiracion($itemId);
        }

        /**
         * Guardamos los datos de multiselección
         */
        if($res["res"]){
            $id = $res["id"];
            /**
             * actividad
             */
            $resultado = $this->saveMultiSelectionData(
                $this->table["institucion_actividad"]
                , "institucion_id"
                , $id
                , "actividad_id"
                , $rec["institucion_actividad"]
            );
        }
        return $res;
    }

    function processData($form,$rec,$action="new"){
        $dataResult = array();
        switch($form){
            case 'module':
                $dataResult = $this->processFields($rec,$this->campos[$form],$action);


                /**
                 * Additional processes when saving the data
                 */
                if ($action=="new"){
                    //$dataResult["active"] = 1;
                }
//                if ($dataResult["norma_id"]=="" or $dataResult["norma_id"]==0){
//                    $dataResult["norma_id"] = NULL;
//                }
                break;
        }
        return $dataResult;
    }

    private function setFechasInscripcionExpiracion($id){
        if($id!=""){
            /**
             * Calculamos fechas
             */
            $sql = "SELECT min(fecha_inscripcion) as fecha_inscripcion, max(fecha_expiracion) as fecha_expiracion
                    FROM ".$this->table["institucion_inscripcion"]." where institucion_id=".$id;
            $res = $this->dbm->execute($sql);
            $item = $res->fields;
            $rec = array();
            if(isset($item["fecha_inscripcion"]) && $item["fecha_inscripcion"]!=""){
                $rec["fecha_inscripcion"]=$item["fecha_inscripcion"];
            }else{
                $rec["fecha_inscripcion"]= NULL;
            }

            if(isset($item["fecha_expiracion"]) && $item["fecha_expiracion"]!=""){
                $rec["fecha_expiracion"]=$item["fecha_expiracion"];
            }else{
                $rec["fecha_expiracion"]= NULL;
            }
            /**
             * Se guarda la información
             */
            $where = "id = ".$id;
            $table = $this->table["institucion"];
            $resp = $this->dbm->AutoExecute($table,$rec,"UPDATE",$where);
        }
    }

}