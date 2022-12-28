<?PHP
namespace App\Vicuna\Esquila\General;
use Core\CoreResources;

class Index extends CoreResources
{
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
    function updateData($rec,$itemId,$action){
//        print_struc($rec);exit;
        $form="module";
        $itemData  = $this->processData($form,$rec,$action, $itemId);
        /**
         * Save processed data
         */
        $field_id="id";
        $res = $this->updateItem($itemId,$itemData ,$this->table[$this->objTable],$action,$field_id);
        $res["accion"] = $action;
        if( $res["res"]==1){
            $this->setProvincia($itemData["municipio_id"], $itemId);
        }

        return $res;
    }

    function processData($form,$rec,$action="new", $itemId){
        $dataResult = array();
        switch($form){
            case 'module':
                $dataResult = $this->processFields($rec,$this->campos[$form],$action);


                /**
                 * Additional processes when saving the data
                 */
                if ($action=="new"){
                }

                break;
        }
        $dataResult["provincia"] = $this->getItemProvincia($rec["municipio_id"])["provincia"];
        $dataResult["departamento"] = $this->getItemProvincia($rec["municipio_id"])["departamen"];
        $dataResult["municipio"] = $this->getItemProvincia($rec["municipio_id"])["name"];
        return $dataResult;
    }

    private function setProvincia($provincia_id, $itemId){
        if($provincia_id!=""){
            /**
             * Llenar datos de provincia
             */
            $sql = "SELECT * 
                    FROM geo.municipio where id=".$provincia_id;
            $res = $this->dbm->execute($sql);
            $item = $res->fields;
            $rec = array();
                $rec["provincia"]=$item["provincia"];
                $rec["departamento"]=$item["departamen"];
                $rec["municipio"]=$item["name"];
            /**
             * Se guarda la información
             */
            $where = "id = ".$itemId;
            $table = $this->table["esquila"];
            $this->dbm->AutoExecute($table,$rec,"UPDATE",$where);
        }
    }

    function getItemProvincia($id){
        $sql = "select * from geo.municipio where id = '".$id."'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

}