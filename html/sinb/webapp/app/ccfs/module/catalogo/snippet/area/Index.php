<?PHP
namespace App\Icas\Module\Catalogo\Snippet\Area;
use Core\CoreResources;

class Index extends CoreResources
{
    var $objTable = "icas_area";
    var $folder = "area";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();

    }
    function getItem($id,$item_id){
        $sql = "select * from ".$this->table[$this->objTable]." as p where p.id = '".$id."'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }
    public function getItemDatatableRows(){
        global $dbSetting;
        $table = $this->table[$this->objTable];
        $primaryKey = '"id"';
        $grid = "index";
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
            $result['data'][$itemId]['created_at'] = $this->changeDataFormat($result['data'][$itemId]['created_at'],"d/m/Y H:i:s");
            $result['data'][$itemId]['updated_at'] = $this->changeDataFormat($result['data'][$itemId]['updated_at'],"d/m/Y H:i:s");
        }
        $result["recordsTotal"]=$result["recordsFiltered"];
        return $result;
    }
    function updateData($rec,$itemId,$form,$action,$item_id, $input_file){
        //print_struc($_FILES);
        $tabla = $this->table[$this->objTable];
        $itemData  = $this->processData($form,$rec,$action,$item_id);
        //print_r($rec);exit();
        /**
         * Save processed data
         */
        $field_id="id";
        $res = $this->updateItem($itemId,$itemData ,$tabla,$action,$field_id);
        $res["accion"] = $action;
        /**
         * Process attachment
         */


        if( $res["res"]==1){
            $item = $this->getItem($res["id"],$item_id);
            $item_id_name = $this->fkey_field;
            $id_name = "id";
            $adjunto = $this->saveAttachment($item,$tabla,$input_file,$item_id,$res["id"],$action,$this->folder,$item_id_name,$id_name);

        }
        return $res;
    }
    function processData($form,$rec,$action="new",$item_id){
        $dataResult = array();
        switch($form){
            case 'index':
                $dataResult = $this->processFields($rec,$this->campos[$form],$action);
                /**
                 * Additional processes when saving the data
                 */
                if ($action=="new"){
                    $dataResult["activo"] = "true";
                    $dataResult[$this->fkey_field]= $item_id;
                }
                break;

        }
        return $dataResult;
    }
    function deleteData($id,$item_id){
        $field_id="id";
        $res = $this->deleteItem($id,$field_id,$this->table[$this->objTable]);
        return $res;
    }

}