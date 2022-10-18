<?PHP
namespace App\Cites\Module\Empresa\Snippet\Index;
use Core\CoreResources;

class Index extends CoreResources {
    var $objTable = "empresa";
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
            $sql = "select i.itemId as id, i.* from ".$this->table[$this->objTable]." as i where i.itemId=".$idItem;
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        return $info;
    }


    public function getItemDatatableRows(){
        global $dbSetting;
        $table = $this->table[$this->objTable];
        //$primaryKey = 'id';
        $primaryKey = 'itemId';
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
            $field = "dateCreate";
            if(isset($result['data'][$itemId][$field])) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y H:i:s");
            $field = "dateUpdate";
            if(isset($result['data'][$itemId][$field])) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y H:i:s");
            $field = "usuario_datecreate";
            if(isset($result['data'][$itemId][$field])) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y H:i:s");
            $field = "usuario_verificafecha";
            if(isset($result['data'][$itemId][$field])) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y H:i:s");

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

}