<?PHP
namespace App\Setting\Module\User\Snippet\Permits;
use Core\CoreResources;
class Index extends CoreResources
{
    var $objTable = "user_module";
    var $folder = "pagos";
    var $fkey_field = "user_id";

    function __construct(){
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }
    /**
     * Implementación desde aca
     */

    function getUserModules($id){
        //$this->dbm->debug = true;
        $sql = "select array_to_string(
ARRAY(select app_module_id from ".$this->table["user_module"]." as m 
where m.user_id=".$id.")
,',') as total ";

        $item = $this->dbm->Execute($sql);
        $item = $item->fields;

        return $item["total"];
    }

    public function getItemFormDatatableRows($item_id){
        global $dbSetting;
        $table = $this->table["app_module"];
        $primaryKey = 'id';
        $grid = "form";
        $db=$dbSetting[0];
        /**
         * Additional configuration
         */
        $userModule = $this->getUserModules($item_id);
        $extraWhere = "";
        if($userModule!=""){
            $extraWhere = " i.id not in (".$userModule.") and i.active=true ";
        }
        $groupBy = "";
        $having = "";
        /**
         * Result of the query sent
         */
        $result = $this->getGridDatatableSimple($db,$grid,$table, $primaryKey, $extraWhere);
        //$result["recordsTotal"]=$result["recordsFiltered"];
        return $result;
    }

    public function getItemDatatableRows($item_id){
        global $dbSetting;
        $table = $this->table[$this->objTable];
        $primaryKey = 'id';
        $grid = "index";
        $db=$dbSetting[0];
        /**
         * Additional configuration
         */
        $extraWhere = $this->fkey_field."='".$item_id."' " ;
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


    function getUserModuleUse($ids,$item_id){
        //$this->dbm->debug = true;
        $sql = "select app_module_id from ".$this->table[$this->objTable]." where user_id='".$item_id."'  and app_module_id in (".$ids.") ";
        $item = $this->dbm->Execute($sql);
        $item = $item->getRows();

        $res = array();
        if(count($item)>0){
            foreach ($item as $row){
                $res[] = $row["app_module_id"];
            }
        }
        return $res;
    }
    function updateData($rec,$form,$item_id){
        $action = "new";
        $tabla = $this->table[$this->objTable];
        $itemData  = $this->processData($form,$rec,$action,$item_id);
        /**
         * Verificamos si alguno de los módulos ingresados ya se encuentran configurados
         */
        $userModule = $this->getUserModuleUse($rec["module"],$item_id);
        $modules = explode(",",$rec["module"]);

        if(count($userModule)>0){
            $modulerec = array_diff( $modules,$userModule);
        }else{
            $modulerec = $modules;
        }

        if(count($modulerec)>0){
            foreach ($modulerec as $row){
                $recModule = $itemData;
                //$recModule[$this->fkey_field] = $item_id;
                $recModule["app_module_id"] = $row;
                /**
                 * Save processed data
                 */
                $field_id="id";
                $res = $this->updateItem("",$recModule ,$tabla,$action,$field_id);
                $res["accion"] = $action;
            }
        }else{
            $res["res"] = 1;
        }

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
                    $dataResult[$this->fkey_field]= $item_id;
                    $dataResult["add"] = "true";
                    $dataResult["edit"] = "true";
                    $dataResult["delete"] = "true";
                }
                break;

        }
        return $dataResult;
    }

    function getItem($id,$item_id){
        $sql = "select * from ".$this->table[$this->objTable]." as p where p.id = '".$id."' and p.".$this->fkey_field." = '".$item_id."'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

    function deleteData($id,$item_id){
        $item = $this->getItem($id,$item_id);
        /**
         * borramos el archivo primero
         */
        $this->deleteAttachmentFile($id,$item_id,$item["attached_extension"],$this->folder);
        /**
         * Delete the record from the database
         */
        $field_id="id";
        $where = $this->fkey_field."='".$item_id."'";
        $res = $this->deleteItem($id,$field_id,$this->table[$this->objTable],$where);
        return $res;
    }

    function getUserModule($item_id,$user_module_id){
        $sql = "select * from ".$this->table[$this->objTable]." where id=:id and user_id=:user_id ";
        $data = array();
        $data["id"] = $user_module_id;
        $data["user_id"] = $item_id;

        $item = $this->dbm->Execute($sql,$data);
        $item = $item->fields;
        return $item;
    }

    function saveCheck($item_id,$user_module_id,$permitType,$value){

        $exits = $this->getUserModule($item_id,$user_module_id);
        if($exits["id"]){
            $rec = array();
            if($value){
                $value = "true";
            }else{
                $value = "false";
            }
            switch ($permitType){
                case 1:
                    $rec["add"] = $value;
                    if($value=="true") $rec["edit"] = $value;
                    break;
                case 2:
                    $rec["edit"] = $value;
                    if($value=="false"){
                        $rec["add"] = $value;
                        $rec["delete"] = $value;
                    }
                    break;
                case 3:
                    $rec["delete"] = $value;
                    if($value=="true") $rec["edit"] = $value;
                    break;
            }

            $rec["updated_at"] =  date("Y-m-d H:i:s");
            $rec["user_update"] = $this->userId;
            $where = "id='".$user_module_id."' and user_id='".$item_id."' ";

            $resupdate = $this->dbm->AutoExecute($this->table[$this->objTable],$rec,"UPDATE",$where);

            if($resupdate){
                $res["res"] = 1;
                $res["id"] = $user_module_id;
            }else{
                $res["res"] = 2;
                $res["msg"] = "No se logro actualizar la informacion en la B.D.";
                $res["msgdb"] = $this->dbm->ErrorMsg();
            }
        }else{
            $res["res"] = 3;
            $res["msg"] = "No Existe el dato que se quiere modificar";
        }



        return $res;
    }
}
