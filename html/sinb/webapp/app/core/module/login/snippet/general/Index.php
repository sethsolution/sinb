<?PHP
class Index extends CoreResources
{
    var $item_form;
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();

    }

    function updateData($rec,$itemId,$form,$action){

        $itemData  = $this->processData($form,$rec,$action);
        /**
         * Save processed data
         */
        $field_id="itemId";
        $res = $this->updateItem($itemId,$itemData ,$this->table["c_ip_publica"],$action,$field_id);
        $res["accion"] = $action;

        return $res;
    }

    function processData($form,$rec,$action="new"){
        $dataResult = array();
        switch($form){
            case 'c_ip_publica':

                $dataResult = $this->processFields($rec,$this->campos[$form],$action);
                /**
                 * Additional processes when saving the data
                 */

                break;
            case 'otros_formularios':
                break;
        }
        return $dataResult;
    }
   }
