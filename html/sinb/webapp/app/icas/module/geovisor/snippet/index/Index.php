<?PHP
namespace App\Icas\Geovisor\Index;
use Core\CoreResources;

class Index extends CoreResources {
    var $objTable = "proyecto";
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
            $where = " where p.departamento_id in (".$item["departamento"].")  ";
        }

        if( isset($item["filtro_estado"]) and trim($item["filtro_estado"])!="" ){
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= " p.estado_id in (".$item["filtro_estado"].")  ";
        }

        return $where;
    }

    function getPoint($filter){

        //$this->dbm->debug = true;
        $sql = "select 
                tc.nombre as tipo_conexion
                ,c.nombre as categoria_nombre
                ,fg.nombre  as tipo_fuente_generacion
                ,g.* from ".$this->table["gd"]." as g 
                left join ".$this->table["gd_tipo_conexion"]." as tc on tc.id=g.gd_tipo_conexion_id
                left join ".$this->table["gd_categoria"]." as c on c.id=g.gd_categoria_id
                left join ".$this->table["gd_tipo_fuente_generacion"]." as fg on fg.id=g.gd_tipo_fuente_generacion_id
        ";
        $sql = "select 
                p.* from ".$this->table["proyecto"]." as p       
        ";

        $where = $this->get_filtro_where($filter);

        if($where != ""){
            $sql .= " ".$where." and";
        }else{
            $sql .= " where ";
        }
        $sql .= "  ((location_longitude_decimal is not null and  location_latitude_decimal is not null) or (location_longitude_decimal <> 0 and  location_latitude_decimal <> 0) )";
        //$sql .= " limit 5";

        /*
        print_struc($filter);
        print_struc($where);
        print_struc($sql);
        exit;
        */
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


            unset($row["institucion_id"]);
            unset($row["institucion_nombre"]);
            unset($row["institucion_direccion"]);
            unset($row["institucion_telefono"]);
            unset($row["institucion_fax"]);
            unset($row["institucion_celular"]);
            unset($row["institucion_email"]);
            unset($row["institucion_web"]);
            unset($row["institucion_responsable_nombre"]);
            unset($row["institucion_responsable_cargo"]);
            unset($row["institucion_responsable_ci"]);
            unset($row["institucion_responsable_fecha"]);
            unset($row["institucion_responsable_operativo_nombre"]);
            unset($row["institucion_responsable_operativo_cargo"]);
            unset($row["institucion_responsable_operativo_ci"]);
            unset($row["institucion_responsable_operativo_fecha"]);
            unset($row["refrendado_dgbap_director"]);
            unset($row["refrendado_dgbap_fecha"]);

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
        return $res;
    }

    function getSummary($item=""){

        //$this->dbm->debug = true;
        //print_struc($this->table);
        $sql = "select 
                p.estado_id, count(*) as total
                from ".$this->table["proyecto"]." as p
                ";
        $where = $this->get_filtro_where($item);
        //$sql .= $where;

        if($where != ""){
            $sql .= " ".$where." and";
        }else{
            $sql .= " where ";
        }

        $sql .= "  ((location_longitude_decimal is not null and  location_latitude_decimal is not null) or (location_longitude_decimal <> 0 and  location_latitude_decimal <> 0) )";

        $sql .= " group by p.estado_id";

/*
        print_struc($item);
        print_struc($sql);
        exit;
*/
        $info = $this->dbm->Execute($sql);
        $info = $info->getRows();


        $res = array();
        $total = 0;
        foreach ($info as $row){
            $total = $total + $row["total"];
            switch ($row["estado_id"]){
                case 1:
                    $res["aprobada"] = round($row["total"],0);
                    break;
                case 2:
                    $res["aclaracion"] = round($row["total"],0);
                    break;
                case 3:
                    $res["rechazada"] = round($row["total"],0);
                    break;
                case 4:
                    $res["paralizada"] = round($row["total"],0);
                    break;
                case 5:
                    $res["recibido"] = round($row["total"],0);
                    break;
                case 6:
                    $res["observado"] = round($row["total"],0);
                    break;
                case 7:
                    $res["no_autorizado"] = round($row["total"],0);
                    break;
                default:
                    $res["none"] = round($row["total"],0);
                    break;
            }
        }

        if(!isset($res["aprobada"])) $res["aprobada"]=0;
        if(!isset($res["aclaracion"])) $res["aclaracion"]=0;
        if(!isset($res["rechazada"])) $res["rechazada"]=0;
        if(!isset($res["paralizada"])) $res["paralizada"]=0;
        if(!isset($res["recibido"])) $res["recibido"]=0;
        if(!isset($res["observado"])) $res["observado"]=0;
        if(!isset($res["no_autorizado"])) $res["no_autorizado"]=0;
        if(!isset($res["none"])) $res["none"]=0;

        $res["total"] = round($total,0);
        return $res;
    }
}