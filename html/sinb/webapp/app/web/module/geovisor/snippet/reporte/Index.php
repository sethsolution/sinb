<?PHP
namespace App\Sinpreh\Module\Geovisor\Snippet\Reporte;
use Core\CoreResources;
class Index extends CoreResources
{
    var $objTable = "proyecto";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();

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

    public function getData($item){
        $wheregd = $this->get_filtro_where($item);
        $wheregd = str_replace("p.","p2.",$wheregd);

        if($wheregd != ""){
            $wheregd .= " and ";
        }else{
            $wheregd = " where ";
        }


        $wheregd .= "  ((p2.location_longitude_decimal is not null and  p2.location_latitude_decimal is not null) or 
        (p2.location_longitude_decimal <> 0 and  p2.location_latitude_decimal <> 0) ) and ";
        //print_struc($wheregd);

        $sql = "select d.name as departamento,g.*
                from(
                select p.departamento_id, count(p.departamento_id) as total
                , (select count(*) from ".$this->table[$this->objTable]." as p2 ".$wheregd." p2.departamento_id = p.departamento_id and p2.estado_id=1) as cerrado
                , (select count(*) from ".$this->table[$this->objTable]." as p2 ".$wheregd." p2.departamento_id = p.departamento_id and p2.estado_id=2) as paralizado
                , (select count(*) from ".$this->table[$this->objTable]." as p2 ".$wheregd." p2.departamento_id = p.departamento_id and p2.estado_id=3) as debito
                , (select count(*) from ".$this->table[$this->objTable]." as p2 ".$wheregd." p2.departamento_id = p.departamento_id and p2.estado_id=4) as concluido
                , (select count(*) from ".$this->table[$this->objTable]." as p2 ".$wheregd." p2.departamento_id = p.departamento_id and p2.estado_id=5) as cancelado
                , (select count(*) from ".$this->table[$this->objTable]." as p2 ".$wheregd." p2.departamento_id = p.departamento_id and p2.estado_id=6) as ejecucion
                , (select count(*) from ".$this->table[$this->objTable]." as p2 ".$wheregd." p2.departamento_id = p.departamento_id and p2.estado_id=7) as programado
                , (select count(*) from ".$this->table[$this->objTable]." as p2 ".$wheregd." p2.departamento_id = p.departamento_id and p2.estado_id=null) as none
                from ".$this->table[$this->objTable]." as p ";

        $where = $this->get_filtro_where($item);


        if($where != ""){
            $sql .= " ".$where." and";
        }else{
            $sql .= " where ";
        }
        $sql .= "  ((location_longitude_decimal is not null and  location_latitude_decimal is not null) or (location_longitude_decimal <> 0 and  location_latitude_decimal <> 0) )";

        $sql .=" group by p.departamento_id) as g
                left join geo.departamento as d on d.id=g.departamento_id ";

        $info = $this->dbm->Execute($sql);
        $info = $info->getRows();

/*
        foreach ($info as $clave => $row){
            $info[$clave]["fuente"] = $this->getFuenteGeneracion($row["departamento_id"],$item);
        }
/*/

        return $info;
    }

    public function getFuenteGeneracion($id,$item){
        $wheregd = $this->get_filtro_where($item);
        $sql = "select fg.id ,fg.nombre ,\n ( select count(*) from gd as g ";
        if($wheregd != ""){
            $sql .= " ".$wheregd;
            $sql .= " and ";
        }else{
            $sql .= " where ";
        }
        $sql .= "g.departamento_id=".$id." 
                and g.gd_tipo_fuente_generacion_id = fg.id ) as total
                from ".$this->table["gd_tipo_fuente_generacion"]." as fg ";

        $info = $this->dbm->Execute($sql);
        $info = $info->getRows();
        return $info;
    }

}