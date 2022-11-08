<?PHP
namespace App\Setting\Module\App\Snippet\General;
use Core\CoreResources;
class Index extends CoreResources
{
    var $objTable = "app";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }

    function updateData($rec,$itemId,$action,$form="module"){
        $itemData  = $this->processData($form,$rec,$action);
        if(count($itemData)){
            /**
             * Save processed data
             */
            $field_id="id";
            $res = $this->updateItem($itemId,$itemData ,$this->table[$this->objTable],$action,$field_id);
            $res["accion"] = $action;
        }else{
            $res["res"] = 2;
            $res["msg"] = "No existe datos de registro";
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
                break;
        }
        return $dataResult;
    }
}