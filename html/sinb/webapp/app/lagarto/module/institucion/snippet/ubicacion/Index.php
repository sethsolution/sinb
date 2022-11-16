<?PHP
namespace App\Lagarto\Module\Institucion\Snippet\Ubicacion;
use Core\CoreResources;
class Index extends CoreResources
{
    var $objTable = "proyecto_ubicacion";
    var $fkey_field = "proyecto_id";

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


    function updateData($rec,$itemId,$form,$action,$item_id=""){
        /**
         * TAblas que usara
         */
        switch($form){
            case 'index': $tabla = $this->table[$this->objTable];
                break;
            case 'module': $tabla = $this->table["institucion"];
                break;
        }

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
        if( $res["res"]==1){
            /**
             * Reconfiguraremos la relación del departamento y municipio principal
             */
            switch($form){
                case 'index': $this->setUbicacion($item_id);
                    break;
                case 'module':
                    $fieldGeom = "geom";
                    $requestGeom = $this->setGeomPointPostgis(
                        $itemData["location_longitude_decimal"]
                        ,$itemData["location_latitude_decimal"]
                        ,"institucion"
                        ,$fieldGeom
                        ,$field_id
                        ,$res["id"]
                    );
                    if($requestGeom["res"]!=1){
                        $res = $requestGeom;
                    }

                    break;
            }
        }
        return $res;
    }

    function setUbicacion($item_id){
        $utotalMain = $this->getTotalUbicaion($item_id,TRUE);
        $totalMain = count($utotalMain);

        if($totalMain == 0){
            $utotal = $this->getTotalUbicaion($item_id);
            $total = count($utotal);
            if($total>0){
                $rec = array();
                $rec["main"] = "TRUE";
                $tabla = $this->table[$this->objTable];
                $where = "id=".$utotal[0]["id"];
                $this->dbm->autoExecute($tabla,$rec,"UPDATE",$where);
            }
        }

        /**
         * Volvemos a verificar para poder guardar en la tabla principal
         * institucion
         */
        $utotalMain = $this->getTotalUbicaion($item_id,TRUE);
        $total = count($utotalMain);
        $utotal = $utotalMain[0];
        $rec = array();
        if($total == 1){
            $rec["departamento_id"] = $utotal["departamento_id"];
            $rec["municipio_id"] = $utotal["municipio_id"];
            /**
             * Sacamos los datos del municipio
             */
            $sql = "select * from geo.municipio as m where m.id = ".$utotal["municipio_id"];
            $item = $this->dbm->Execute($sql);
            $item = $item->fields;
            $rec["departamento"] = $item["departamen"];
            $rec["provincia"] = $item["provincia"];
            $rec["municipio"] = $item["name"];
            //print_struc($rec);
            //print_struc($rec);
        }else{
            $rec["departamento_id"] = NULL;
            $rec["municipio_id"] = NULL;
        }

        $tabla = $this->table["institucion"];
        $where = "id=".$item_id;
        $this->dbm->autoExecute($tabla,$rec,"UPDATE",$where);

    }

    function getTotalUbicaion($id,$main=""){
        $where = "";
        if($main){
            $where = " pu.main = TRUE and";
        }
        $sql = "select * from proyecto_ubicacion as pu where ".$where." pu.proyecto_id = ".$id;
        $item = $this->dbm->Execute($sql);
        $item = $item->GetRows();
        return $item;
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
                    /**
                     * Por defecto si al crear el primer registro es único
                     * se considerará principal
                     */
                    $dataResult[$this->fkey_field]= $item_id;
                    $utotal = $this->getTotalUbicaion($item_id);
                    if(count($utotal)==0){
                        $dataResult["main"] = "TRUE";
                    }
                }else{

                }
                $dataResult["provincia"] = $this->getItemProvincia($rec["municipio_id"])["provincia"];
                break;

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

    function getItem($id,$item_id){
        $sql = "select * from ".$this->table[$this->objTable]." as p where p.id = '".$id."' and p.".$this->fkey_field." = '".$item_id."'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }
    function getItemProvincia($id){
        $sql = "select * from geo.municipio where id = '".$id."'";
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

    function deleteData($id,$item_id){
        /**
         * Delete the record from the database
         */
        $field_id="id";
        $where = $this->fkey_field."='".$item_id."'";
        $res = $this->deleteItem($id,$field_id,$this->table[$this->objTable],$where);

        if( $res["res"]==1){
            /**
             * Reconfiguraremos la relación del departamento y municipio principal
             */
            $this->setUbicacion($item_id);
        }


        return $res;
    }

    public function setMain($id,$item_id){
        if($id>0 and $item_id>0){
            $sql = "update proyecto_ubicacion as pu set main=FALSE where pu.proyecto_id =".$item_id;
            $this->dbm->execute($sql);

            $sql = "update proyecto_ubicacion as pu set main=TRUE where pu.id = ".$id;
            $this->dbm->execute($sql);

            $this->setUbicacion($item_id);
        }
        $res = array();
        $res["res"] = 1;
        $res["id"] = $id;
        return $res;
    }

}
