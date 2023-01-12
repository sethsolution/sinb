<?PHP
namespace App\Icas\Report\Icas;
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

    function getEstadoTotal($estado_id,$financiamiento_id){
        $sql = "select p.estado_id, count(*) as total
                FROM icas.proyecto_institucion as pi
                left join icas.proyecto as p on p.id = pi.proyecto_id
                where p.fuente_financiamiento_id = ".$financiamiento_id." and p.estado_id=".$estado_id."
                GROUP BY p.estado_id";
        $dato = $this->dbm->Execute($sql);
        $dato = $dato->fields;

        $total = $dato["total"]==""?0:$dato["total"];
        return $total;
    }

    function get_filtro_where($item){
        $where = "";

        if(isset($item["departamento_id"])  and is_array($item["departamento_id"])){
            $filtro =  implode(',',$item["departamento_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "p.departamento_id in (".$filtro.")  ";
        }

        if(isset($item["estado_id"])  and is_array($item["estado_id"])){
            $filtro =  implode(',',$item["estado_id"]);
            $where = " where p.estado_id in (".$filtro.") ";
        }

        if(isset($item["area_id"])  and is_array($item["area_id"])){
            $filtro =  implode(',',$item["area_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "p.area_id in (".$filtro.")  ";
        }

        if(isset($item["fuente_financiamiento_id"])  and is_array($item["fuente_financiamiento_id"])){
            $filtro =  implode(',',$item["fuente_financiamiento_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "p.fuente_financiamiento_id in (".$filtro.")  ";
        }

        if(isset($item["institucion_id"])  and is_array($item["institucion_id"])){
            $filtro =  implode(',',$item["institucion_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "pi.institucion_id in (".$filtro.")  ";
        }

        $res["where"] = $where;
        $res["join"] = "";

        return $res;
    }

    function consulta($item){
        /**
         * Procesamos los filtros
         */
        $filtro = $this->get_filtro_where($item);

        $where = $filtro["where"];
        $join = $filtro["join"];
        /**
         * Datos cantidad de proyectos por ICA
         */
        $icas = $this->getICAS($filtro);
        $res["icas"] = $icas;
//        print_struc($res["icas"]);
        $icasProyecto = $this->getICASProyecto($filtro);
        $res["icasProyecto"] = $icasProyecto;

        return $res;
    }

    public function getICAS($filtro){
        $where = $filtro["where"];
        $join = $filtro["join"];
        /**
         * Sacamos los datos del departamento y sus totales
         */
        $sql = "select 
                CASE
                    WHEN i.nombre is null THEN 'SIN REGISTRO'
                    ELSE i.nombre
                END as ica
            ,
                CASE
                    WHEN dep.institucion_id is null THEN '0'
                    ELSE dep.institucion_id
                END as institucion_id
            , dep.total
            from
            (
            SELECT  
            pi.institucion_id, count(*) as total
            FROM icas.proyecto_institucion as pi
            left join icas.proyecto as p on p.id = pi.proyecto_id
            ".$where."
            group by pi.institucion_id
            ) as dep
            left join icas.institucion as i on i.id = dep.institucion_id
            order by i.nombre
                ";
        $data = $this->dbm->Execute($sql);
        $data = $data->getRows();
        return $data;
    }

    public function getICASProyecto($filtro){
        $where = $filtro["where"];
        $join = $filtro["join"];
        /**
         * Sacamos los datos del departamento y sus totales
         */
        $sql = "select 
                CASE
                    WHEN i.nombre is null THEN 'SIN REGISTRO'
                    ELSE i.nombre
                END as ica
            ,
                CASE
                    WHEN dep.institucion_id is null THEN '0'
                    ELSE dep.institucion_id
                END as institucion_id
            , dep.nombre as proyecto, dep.total
            from
            (
            SELECT  
            pi.institucion_id, p.nombre, count(*) as total
            FROM icas.proyecto_institucion as pi
            left join icas.proyecto as p on p.id = pi.proyecto_id
            ".$where."
            group by pi.institucion_id, p.nombre
            ) as dep
            left join icas.institucion as i on i.id = dep.institucion_id
            order by i.nombre
                ";
        $data = $this->dbm->Execute($sql);
        $data = $data->getRows();
        return $data;
    }


}