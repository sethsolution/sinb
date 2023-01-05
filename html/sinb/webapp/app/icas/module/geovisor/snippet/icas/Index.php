<?PHP
namespace App\Icas\Geovisor\Distribuidora;
use Core\CoreResources;

class Index extends CoreResources {
    var $objTable = "proyecto_institucion";
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
//        $wheregd = $this->get_filtro_where($item);
//        $wheregd = str_replace("p.","p2.",$wheregd);
//
//        if($wheregd != ""){
//            $wheregd .= " and ";
//        }else{
//            $wheregd = " where ";
//        }

        //print_struc($wheregd);

        $sql = "select i.nombre as institucion,g.*
                from(
                select p.institucion_id, count(p.institucion_id) as total
                , (select count(*) from icas.proyecto_institucion as p2 where p2.institucion_id = p.institucion_id and p2.tipo_id=1) as total_ica
				, (select count(*) from icas.proyecto_institucion as p2 where p2.institucion_id = p.institucion_id and p2.tipo_id=2) as total_contraparte
                from ".$this->table[$this->objTable]." as p ";

//        $where = $this->get_filtro_where($item);
//        if($where != ""){
//            $sql .= " ".$where;
//        }

        $sql .=" group by p.institucion_id) as g
                left join icas.institucion as i on i.id=g.institucion_id ";
        //print_struc($sql);exit;
        $info = $this->dbm->Execute($sql);
        $info = $info->getRows();

        //print_struc($info);exit;
        return $info;
    }
    public function getFilter($filter){

        if($filter["filtro_gd_categoria"]==""){
            $cate["nanogeneracion"] = 1;
            $cate["microgeneracion"] = 1;
            $cate["minigeneracion"] = 1;
        }else{
            $cate["nanogeneracion"] = 0;
            $cate["microgeneracion"] = 0;
            $cate["minigeneracion"] = 0;

            $category =  explode(",",$filter["filtro_gd_categoria"]);
            foreach ($category as $item) {
                switch ($item){
                    case 1:$cate["nanogeneracion"]=1;break;
                    case 2:$cate["microgeneracion"]=1;break;
                    case 3:$cate["minigeneracion"]=1;break;
                }
            }

        }
        $res["cate"] = $cate;
        return $res;
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