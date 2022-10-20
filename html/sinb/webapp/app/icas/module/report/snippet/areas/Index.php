<?PHP
namespace App\Icas\Module\Report\Snippet\Areas;
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

    function getEstadoTotal($estado_id,$tipo_id){
        $sql = "select p.estado_id, sum(p.area_intervencion) as total
                from proyecto as p
                where p.tipo_id = ".$tipo_id." and p.estado_id=".$estado_id."
                GROUP BY p.estado_id";
        $dato = $this->dbm->Execute($sql);
        $dato = $dato->fields;

        $total = $dato["total"]==""?0:$dato["total"];
        return $total;
    }

    function get_filtro_where($item){
        $where = "";
        if(isset($item["estado_id"])  and is_array($item["estado_id"])){
            $filtro =  implode(',',$item["estado_id"]);
            $where = " where p.estado_id in (".$filtro.") ";
        }
        if(isset($item["tipo_id"])  and is_array($item["tipo_id"])){
            $filtro =  implode(',',$item["tipo_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "p.tipo_id in (".$filtro.")  ";
        }

        if(isset($item["departamento_id"])  and is_array($item["departamento_id"])){
            $filtro =  implode(',',$item["departamento_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "p.departamento_id in (".$filtro.")  ";
        }

        if(isset($item["municipio_id"])  and is_array($item["municipio_id"])){
            $filtro =  implode(',',$item["municipio_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "p.municipio_id in (".$filtro.")  ";
        }

        if(isset($item["tipo_proyecto_id"])  and is_array($item["tipo_proyecto_id"])){
            $filtro =  implode(',',$item["tipo_proyecto_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "p.tipo_proyecto_id in (".$filtro.")  ";
        }



        $res["where"] = $where;
        $res["join"] = "";

        //print_struc($res);
        return $res;
    }

    public function getYears($filtro){
        $where = $filtro["where"];
        $join = $filtro["join"];
        $sql = "select 
                CASE
                    WHEN min(p.gestion) is null THEN '0'
                    ELSE min(p.gestion)
                END as minimo
                , 
                CASE
                    WHEN max(p.gestion) is null THEN '0'
                    ELSE max(p.gestion)
                END as maximo
                
                
                from proyecto as p
                ".$where."
                ";
        $dato = $this->dbm->Execute($sql);
        $dato = $dato->fields;

        if($dato["minimo"]!=0 and $dato["maximo"]!=0){
            for($i= $dato["minimo"];$i<= $dato["maximo"];$i++){
                $res[] = $i;
            }
        }else{
            $res = array();
        }

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
         * Sacamos el rango de años
         */
        $years = $this->getYears($filtro);
        $res["years"] = $years;
        //print_struc($years);
        /**
         * Sacamos primer totalizado por tipo de proyecto (inversion, preinversion, sin clasificar)
         */
        $sql = "select ct.id ,ct.nombre as tipo,re.total
                from
                (
                select p.tipo_id ,sum(p.area_intervencion) as total
                from proyecto as p 
                ".$where."
                GROUP BY p.tipo_id
                ) as re
                left join catalogo.tipo as ct on ct.id= re.tipo_id
                order by ct.nombre
                ";
        $tipo = $this->dbm->Execute($sql);
        $tipo = $tipo->getRows();
        $res["tipo"] = $tipo;
        /**
         * Sacamos todos los estado utilizados en esta consulta
         */
        $sql = "select ce.id, ce.nombre as estado ,t.*
                    from(
                    select p.estado_id, sum(p.area_intervencion) as total
                    from proyecto as p
                    ".$where."
                    GROUP BY p.estado_id
                    ) as t
                    left join catalogo.estado as ce on ce.id = t.estado_id
                ";
        $estados = $this->dbm->Execute($sql);
        $estados = $estados->getRows();

        /**
         * Datos tipos proyecto
         */
        $tipoProyecto = $this->getProyectoTipo($filtro,$years,$tipo,$estados);
        $res["tipoProyecto"] = $tipoProyecto;
        /**
         * Datos del departamento
         */
        $departamento = $this->getDepartamento($filtro);
        $res["departamento"] = $departamento;

        /**
         * recorremos los tipos y sacamos todos los estados encontrados
         */
        $dato = array();
        $cont = 0;
        foreach ($estados as $row){
            $dato[$cont]["id"] = $row["id"];
            $dato[$cont]["nombre"] = $row["estado"];
            foreach ($tipo as $es){
                $totalItem = $this->getEstadoTotal($row["id"],$es["id"]);
                $dato[$cont]["estado"][] = array("nombre"=>$es["tipo"],"total"=>$totalItem);
            }

            $cont++;
        }

        $res["dato"] = $dato;

        /**
         * Total de todos los proyectos
         */
        $total = 0;
        foreach ($tipo as $row){
            $total = $total + (int)$row["total"];
        }
        $res["total"] = $total;
        /**
         * Sacamos los datos para la tabla
         */
        $sql = "select re.tipo_id, ct.nombre as tipo, ce.nombre as estado, re.total
                from
                (
                select p.tipo_id, p.estado_id, sum(p.area_intervencion) as total
                from proyecto as p
                ".$where."
                GROUP BY p.tipo_id,p.estado_id
                )
                as re
                left join catalogo.tipo as ct on ct.id= re.tipo_id
                left join catalogo.estado as ce on ce.id = re.estado_id
                 order by ct.nombre, ce.nombre
                ";
        $resultado = $this->dbm->Execute($sql);
        $resultado = $resultado->getRows();
        $res["resultado"] = $resultado;

        //print_struc($res);
        return $res;
    }


    public function getTipoYear($year,$id,$where,$join){
        if($where == ""){
            $where .= " where ";
        }else{
            $where .= " and ";
        }
        $year = $year==""?"is null":"=".$year;
        $where .= " p.gestion ".$year;

        $id = $id==0?"is null":"=".$id;
        $where .= " and p.tipo_proyecto_id ".$id;

        $sql = "select sum(p.area_intervencion) as total
                from proyecto as p
                ".$where." ";

        $dato = $this->dbm->Execute($sql);
        $dato = $dato->fields;
        $total = $dato["total"]==""?0:$dato["total"];
        return $total;
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
            p.departamento_id,sum(p.area_intervencion) as total
            FROM proyecto as p
            ".$where."
            group by p.departamento_id
            ) as dep
            left join geo.departamento as d on d.id = dep.departamento_id
            order by d.name";
        //print_struc($sql);
        $data = $this->dbm->Execute($sql);
        $data = $data->getRows();
        //print_struc($data);
        return $data;
    }
    public function getProyectoTipo($filtro,$years,$tipo,$estados){
        $where = $filtro["where"];
        $join = $filtro["join"];
        /**
         * Sacamos todos los tipos de proyectos, incluso los que no estan asignados
         */
        $sql = "select 
                CASE
                    WHEN tp.nombre is null THEN 'SIN REGISTRO'
                    ELSE tp.nombre
                  END  as tipo_proyecto
                ,
                    CASE
                    WHEN pe.tipo_proyecto_id is null THEN '0'
                    ELSE pe.tipo_proyecto_id
                  END  
                    
                ,pe.total
                from
                (
                select 
                p.tipo_proyecto_id, sum(p.area_intervencion) as total
                from proyecto as p
                ".$where."
                group by p.tipo_proyecto_id
                ) as pe
                
                left join catalogo.tipo_proyecto as  tp on tp.id = pe.tipo_proyecto_id";
        $tipo_proyecto = $this->dbm->Execute($sql);
        $tipo_proyecto = $tipo_proyecto->getRows();

        /**
         * Recorremos todos los años
         */
        $dato = array();

        foreach ($years as  $key=> $row){
            $dato[$key]["year"] = $row;
            foreach ($tipo_proyecto as $k => $tipo){
                $total = $this->getTipoYear($row,$tipo["tipo_proyecto_id"],$where,$join);
                $dato[$key]["tipo"][]= array("tipo_proyecto"=>$tipo["tipo_proyecto"],"id"=>$tipo["tipo_proyecto_id"],"total"=>$total);
            }
        }

        $key ++;
        $dato[$key]["year"] = "Sin Dato";
        foreach ($tipo_proyecto as $k => $tipo){
            $total = $this->getTipoYear("",$tipo["tipo_proyecto_id"],$where,$join);
            $dato[$key]["tipo"][]= array("tipo_proyecto"=>$tipo["tipo_proyecto"],"id"=>$tipo["tipo_proyecto_id"],"total"=>$total);
        }
        //print_struc($dato);
        $res["tipo"] = $tipo_proyecto;
        $res["years"] = $dato;
        return $res;
    }

}