<?PHP
namespace App\Ilicito\Ilicito\General;
use Core\CoreResources;

class Index extends CoreResources
{
    var $objTable = "ilicito";
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
            $this->setDepartamento($itemData["departamento_id"], $itemId);
            $this->setProcedencia($itemData["procedencia_id"], $itemId);
            $this->setDestino($itemData["destino_id"], $itemId);
            $this->setEspecie($itemData["especie_id"], $itemId);
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
                }
                break;
        }
        $dataResult["departamento"] = $this->getItemDepartamento($rec["departamento_id"])["name"];
        $dataResult["procedencia"] = $this->getItemProcedencia($rec["procedencia_id"])["nombre"];
        $dataResult["destino"] = $this->getItemDestino($rec["destino_id"])["nombre"];
        $dataResult["nombre_comun"] = $this->getItemEspecie($rec["especie_id"])["nombre_comun"];
        $dataResult["nombre_cientifico"] = $this->getItemEspecie($rec["especie_id"])["nombre"];
        $dataResult["clase"] = $this->getItemEspecie($rec["especie_id"])["descripcion"];
        return $dataResult;
    }

    private function setDepartamento($departamento_id, $itemId){
        if($departamento_id!=""){
            /**
             * Llenar datos de provincia
             */
            $sql = "SELECT * 
                    FROM geo.departamento where id=".$departamento_id;
            $res = $this->dbm->execute($sql);
            $item = $res->fields;
            $rec = array();
            $rec["departamento"]=$item["name"];
            /**
             * Se guarda la información
             */
            $where = "id = ".$itemId;
            $table = $this->table["ilicito"];
            $this->dbm->AutoExecute($table,$rec,"UPDATE",$where);
        }
    }

    function getItemDepartamento($id){
        $sql = "select * from geo.departamento where id = '".$id."'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

    function getItemProcedencia($id){
        $sql = "select * from catalogo.ilicito_procedencia where id = '".$id."'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

    private function setProcedencia($procedencia_id, $itemId){
        if($procedencia_id!=""){
            /**
             * Llenar datos de provincia
             */
            $sql = "SELECT * 
                    FROM catalogo.ilicito_procedencia where id =".$procedencia_id;
            $res = $this->dbm->execute($sql);
            $item = $res->fields;
            $rec = array();
            $rec["procedencia"]=$item["nombre"];
            /**
             * Se guarda la información
             */
            $where = "id = ".$itemId;
            $table = $this->table["ilicito"];
            $this->dbm->AutoExecute($table,$rec,"UPDATE",$where);
        }
    }


    function getItemDestino($id){
        $sql = "select * from ccfs.ccfs where id = '".$id."'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

    private function setDestino($destino_id, $itemId){
        if($destino_id!=""){
            /**
             * Llenar datos de provincia
             */
            $sql = "SELECT * 
                    FROM ccfs.ccfs where id =".$destino_id;
            $res = $this->dbm->execute($sql);
            $item = $res->fields;
            $rec = array();
            $rec["destino"]=$item["nombre"];
            /**
             * Se guarda la información
             */
            $where = "id = ".$itemId;
            $table = $this->table["ilicito"];
            $this->dbm->AutoExecute($table,$rec,"UPDATE",$where);
        }
    }

    function getItemEspecie($id){
        $sql = "select * from catalogo.cites_especie where id = '".$id."'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

    private function setEspecie($especie_id, $itemId){
        if($especie_id!=""){
            /**
             * Llenar datos de provincia
             */
            $sql = "SELECT * 
                    FROM catalogo.cites_especie where id =".$especie_id;
            $res = $this->dbm->execute($sql);
            $item = $res->fields;
            $rec = array();
            $rec["nombre_comun"]=$item["nombre_comun"];
            $rec["nombre_cientifico"]=$item["nombre"];
            $rec["clase"]=$item["descripcion"];
            /**
             * Se guarda la información
             */
            $where = "id = ".$itemId;
            $table = $this->table["ilicito"];
            $this->dbm->AutoExecute($table,$rec,"UPDATE",$where);
        }
    }
}