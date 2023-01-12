<?PHP
namespace App\Ilicito\Geovisor\Index;
use Core\CoreResources;

class Index extends CoreResources {
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


    public function getItemDatatableRows(){
        global $dbSetting;
        $table = $this->table[$this->objTable];
        $primaryKey = 'id';
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

    function get_filtro_where($item){
        $where = "";
        if( isset($item["departamento"]) and trim($item["departamento"])!="" ){
            $where = " p.departamento_id in (".$item["departamento"].")  ";
        }

        return $where;
    }

    function getPoint($filter){

        //$this->dbm->debug = true;
        $sql = "select 
                p.* from ".$this->table["ilicito"]." as p       
        ";

        $where = $this->get_filtro_where($filter);

        if($where != ""){
            $sql .= " where ".$where." and";
        }else{
            $sql .= " where ";
        }
        $sql .= "  ((location_longitude_decimal is not null and  location_latitude_decimal is not null) or (location_longitude_decimal <> 0 and  location_latitude_decimal <> 0) )";
        //$sql .= " limit 5";

//        print_struc($sql);exit;
        $info = $this->dbm->Execute($sql);
        $dato = $info->getRows();

        $res = array();
        $res["type"] = "FeatureCollection";

        foreach ($dato as $row){

            unset($row["geom"]);
            unset($row["created_at"]);
            unset($row["updated_at"]);

            unset($row["user_create"]);
            unset($row["user_update"]);

//            unset($row["comentario"]);

            unset($row["location_latitude"]);
            unset($row["location_longitude"]);
            unset($row["location_utm_north"]);
            unset($row["location_utm_east"]);
            unset($row["location_utm_zone"]);
            unset($row["location_utm_hemisphere"]);
            unset($row["location_altitude"]);


            $row["fecha"] = date_format(date_create($row["fecha"]),"d/m/Y");


            $item["geometry"]["type"] = "Point";
            $item["geometry"]["coordinates"] = array($row["location_longitude_decimal"],$row["location_latitude_decimal"]);
            $item["type"]="Feature";
            $item["id"]=$row["id"];
            $item["properties"]=$row;

            $res["features"][]=$item;

            //print_struc($res["features"]);
            //exit;
        }

        if(!isset($res["features"])){
            $res["features"][]="";
        }
        //print_struc($res);exit();
        return $res;
    }

    function getSummary($item=""){

        //$this->dbm->debug = true;
        //print_struc($this->table);
        $sql = "select 
                dep.name, count(p.departamento_id) as total
                from (SELECT id, name from ".$this->table["departamento"]." WHERE cod_dep!='0') as dep
                LEFT JOIN ".$this->table["ilicito"]." as p on p.departamento_id=dep.id
                ";
        $where = $this->get_filtro_where($item);
        //$sql .= $where;

        if($where != ""){
            $sql .= " AND ".$where." and";
        }else{
            $sql .= " AND ";
        }

        $sql .= "  ((p.location_longitude_decimal is not null and  p.location_latitude_decimal is not null) or (p.location_longitude_decimal <> 0 and  p.location_latitude_decimal <> 0) )";

        $sql .= " group by dep.name order by total desc";

/*
        print_struc($item);
        print_struc($sql);
        exit;
*/

        $info = $this->dbm->Execute($sql);
        $info = $info->getRows();


        $res = [];
//        $res = array();
        $total = 0;
        foreach ($info as $row){
            $total = $total + $row["total"];
//            $res[$row["name"]] = round($row["total"],0);
            $res[] = array( "nombre" => $row["name"], "total" => $row["total"] );
        }
        $res[] = array( "nombre" => "TOTAL", "total" => round($total,0) );
//        $res["TOTAL"] = round($total,0);
        return $res;
    }
}