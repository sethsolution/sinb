<?PHP
namespace App\Setting\Module\App\Snippet\Group;
use Core\CoreResources;
class Index extends CoreResources
{
    var $objTable = "app_group";
    function __construct(){
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }
    /**
     * Implementación desde aca
     */

    public function getItemDatatableRows($item_id){
        global $dbSetting;
        $table = $this->table[$this->objTable];
        $primaryKey = 'id';
        $grid = "index";
        $db=$dbSetting[0];
        /**
         * Additional configuration
         */
        $extraWhere = "app_id='".$item_id."' " ;
        $groupBy = "";
        $having = "";
        /**
         * Result of the query sent
         */
        $result = $this->getGridDatatableSimple($db,$grid,$table, $primaryKey, $extraWhere, $groupBy, $having);
        //$result["recordsTotal"]=$result["recordsFiltered"];
        return $result;
    }


    function updateData($rec,$itemId,$form,$action,$item_id ){
        $tabla = $this->table[$this->objTable];
        $itemData  = $this->processData($form,$rec,$action,$item_id);
        /**
         * Save processed data
         */
        $field_id="id";
        $res = $this->updateItem($itemId,$itemData ,$tabla,$action,$field_id);
        $res["accion"] = $action;
        /**
         * Process attachment
         */
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
                    $dataResult["app_id"]= $item_id;
                }
                break;

        }
        return $dataResult;
    }

    function getItem($id,$item_id){
        $sql = "select * from ".$this->table[$this->objTable]." as p where p.id = '".$id."' and p.app_id = '".$item_id."'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

    function deleteData($id,$item_id){
        /**
         * borramos el archivo primero
         */
        //$this->item_delete_archivo_sbm($id,$item_id);
        /**
         * Delete the record from the database
         */
        $field_id="id";
        $where = "app_id='".$item_id."'";
        $res = $this->deleteItem($id,$field_id,$this->table[$this->objTable],$where);
        return $res;
    }
}
