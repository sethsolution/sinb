<?PHP
namespace App\Icas\Report\Proyecto;
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
                from icas.proyecto as p
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
         * Sacamos primer totalizado por fuente de financiamiento (IDH, propia y otros)
         */
        $sql = "select ff.id , ff.nombre as financiamiento, re.total
                from
                (
                select p.fuente_financiamiento_id ,count(*) as total
                from icas.proyecto as p 
                ".$where."
                GROUP BY p.fuente_financiamiento_id
                ) as re
                left join catalogo.icas_fuente_financiamiento as ff on ff.id= re.fuente_financiamiento_id
                order by ff.nombre
                ";
        $financiamiento = $this->dbm->Execute($sql);
        $financiamiento = $financiamiento->getRows();
        $res["financiamiento"] = $financiamiento;

        /**
         * Sacamos todos los estado utilizados en esta consulta
         */
        $sql = "select ce.id, ce.nombre as estado ,t.*
                    from(
                    select p.estado_id, count(*) as total
                    from icas.proyecto as p
                    ".$where."
                    GROUP BY p.estado_id
                    ) as t
                    left join catalogo.icas_estado as ce on ce.id = t.estado_id
                ";
        $estados = $this->dbm->Execute($sql);
        $estados = $estados->getRows();;


        /**
         * Datos del departamento
         */
        $departamento = $this->getDepartamento($filtro);
        $res["departamento"] = $departamento;

        /**
         * Datos tipos proyecto
         */
        $areaTematica = $this->getAreaTematica($filtro);
        $res["areaTematica"] = $areaTematica;

        /**
         * recorremos los tipos y sacamos todos los estados encontrados
         */
        $dato = array();
        $cont = 0;
        foreach ($estados as $row){
            $dato[$cont]["id"] = $row["id"];
            $dato[$cont]["nombre"] = $row["estado"];
            foreach ($financiamiento as $es){
                $totalItem = $this->getEstadoTotal($row["id"],$es["id"]);
                $dato[$cont]["financiamiento"][] = array("nombre"=>$es["financiamiento"],"total"=>$totalItem);
            }

            $cont++;
        }

        $res["dato"] = $dato;

        /**
         * Total de todos los proyectos
         */
        $total = 0;
        foreach ($financiamiento as $row){
            $total = $total + (int)$row["total"];
        }
        $res["total"] = $total;
        /**
         * Sacamos los datos para la tabla
         */
        $sql = "select re.fuente_financiamiento_id, ff.nombre as financiamiento, ce.nombre as estado, re.total
                from
                (
                select p.fuente_financiamiento_id, p.estado_id, count(*) as total
                from icas.proyecto as p
                ".$where."
                GROUP BY p.fuente_financiamiento_id,p.estado_id
                )
                as re
                left join catalogo.icas_fuente_financiamiento as ff on ff.id= re.fuente_financiamiento_id
                left join catalogo.icas_estado as ce on ce.id = re.estado_id
                 order by ff.nombre, ce.nombre
                ";
        $resultado = $this->dbm->Execute($sql);
        $resultado = $resultado->getRows();
        $res["resultado"] = $resultado;

        /**
         * Sacamos la lista de proyectos
         */
        $sql = " SELECT p.id
, p.nombre
, p.codigo
, a.nombre as area
, d.name as departamento
, e.nombre as estado
, ff.nombre as financiamiento
, p.fuente_financiamiento_otro
, to_char(p.fecha_inicio, 'DD/MM/YYYY') as fecha_inicio
, to_char(p.fecha_conclusion, 'DD/MM/YYYY') as fecha_conclusion
    FROM icas.proyecto p
        LEFT JOIN catalogo.icas_area a ON a.id = p.area_id
        LEFT JOIN catalogo.icas_estado e ON e.id = p.estado_id
        LEFT JOIN geo.departamento d ON d.id = p.departamento_id
        LEFT JOIN catalogo.icas_fuente_financiamiento ff ON ff.id = p.fuente_financiamiento_id
        ".$where."
        ";
        $resultado = $this->dbm->Execute($sql);
        $resultado = $resultado->getRows();
        $res["proyectos"] = $resultado;

        return $res;
    }

    public function getDepartamento($filtro){
        $where = $filtro["where"];
        $join = $filtro["join"];
        /**
         * Sacamos los datos del departamento y sus totales
         */
        $sql = "select 
                CASE
                    WHEN d.name is null THEN 'SIN REGISTRO'
                    ELSE d.name
                END as departamento
            ,
                CASE
                    WHEN dep.departamento_id is null THEN '0'
                    ELSE dep.departamento_id
                END as departamento_id
            , dep.total
            from
            (
            SELECT  
            p.departamento_id, count(*) as total
            FROM icas.proyecto as p
            ".$where."
            group by p.departamento_id
            ) as dep
            left join geo.departamento as d on d.id = dep.departamento_id
            order by d.name";
        $data = $this->dbm->Execute($sql);
        $data = $data->getRows();
        return $data;
    }

    public function getAreaTematica($filtro){
        $where = $filtro["where"];
        $join = $filtro["join"];
        /**
         * Sacamos los datos del departamento y sus totales
         */
        $sql = "select 
                CASE
                    WHEN ca.nombre is null THEN 'SIN REGISTRO'
                    ELSE ca.nombre
                END as area
            ,
                CASE
                    WHEN dep.area_id is null THEN '0'
                    ELSE dep.area_id
                END as area_id
            , dep.total
            from
            (
            SELECT  
            p.area_id, count(*) as total
            FROM icas.proyecto as p
            ".$where."
            group by p.area_id
            ) as dep
            left join catalogo.icas_area as ca on ca.id = dep.area_id
            order by ca.nombre
                ";
        $data = $this->dbm->Execute($sql);
        $data = $data->getRows();
        return $data;
    }

}