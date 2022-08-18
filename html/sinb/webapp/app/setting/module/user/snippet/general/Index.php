<?PHP
namespace App\Setting\Module\User\Snippet\General;
use Core\CoreResources;
class Index extends CoreResources
{
    var $objTable = "user";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();

    }

    function updateData($rec,$itemId,$action,$form="module"){
        $rec["username"]=strtolower(trim($rec["username"]));
        /**
         * Sacamos los datos del usuario para verificar si no existe.
         */
        $sql = "SELECT * FROM ". $this->table[$this->objTable]." AS u WHERE u.username ='".$rec["username"]."'";
        $it = $this->dbm->Execute($sql);
        $item = $it->fields;

        if($item["id"]=="" or $action=="update") {
            $itemData = $this->processData($form, $rec, $action);
            if (count($itemData)) {
                /**
                 * Save processed data
                 */
                $field_id = "id";
                $res = $this->updateItem($itemId, $itemData, $this->table[$this->objTable], $action, $field_id);
                $res["accion"] = $action;
            } else {
                $res["res"] = 2;
                $res["msg"] = "No existe datos de registro";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "El nombre de usuario ya se encuentra registrado";
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
                if ($action=="new" or $rec["password"]!= ""){
                    //$dataResult["active"] = 1;
                    $dataResult["password"] = md5(trim($dataResult["password"]));
                }else{
                    unset($dataResult["password"]);
                }
                break;
        }
        return $dataResult;
    }
}