<?PHP
namespace App\Icas\Module\Report\Snippet\Proyecto;
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
        $sql = "select p.area_id, count(*) as total
                from icas.proyecto as p
                where p.area_id = ".$tipo_id." and p.area_id=".$estado_id."
                GROUP BY p.area_id";
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

//        print_struc($res);
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
//        $years = $this->getYears($filtro);
//        $res["years"] = $years;
//        print_struc($years);
        /**
         * Sacamos primer totalizado por area de proyecto (Botánica, Zoologia, Genática, etc)
         */
        $sql = "select ct.id ,ct.nombre as area,re.total
                from
                (
                select p.area_id ,count(*) as total
                from icas.proyecto as p 
                ".$where."
                GROUP BY p.area_id
                ) as re
                left join catalogo.icas_area as ct on ct.id= re.area_id
                order by ct.nombre
                ";
//        $this->dbm->debug = true;
        $tipo = $this->dbm->Execute($sql);
        $tipo = $tipo->getRows();
        $res["tipo"] = $tipo;
//        print_struc($res["tipo"]);
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
        $estados = $estados->getRows();
//        print_struc($estados);

        /**
         * Datos tipos proyecto
         */
//        $tipoProyecto = $this->getProyectoTipo($filtro,$years,$tipo,$estados);
//        $res["tipoProyecto"] = $tipoProyecto;
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
                $dato[$cont]["area"][] = array("nombre"=>$es["area"],"total"=>$totalItem);
            }

            $cont++;
        }

        $res["dato"] = $dato;
//        print_struc($res["dato"]);

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
        $sql = "select re.area_id, ct.nombre as area, ce.nombre as estado, re.total
                from
                (
                select p.area_id, p.estado_id, count(*) as total
                from icas.proyecto as p
                ".$where."
                GROUP BY p.area_id,p.estado_id
                )
                as re
                left join catalogo.icas_area as ct on ct.id= re.area_id
                left join catalogo.icas_estado as ce on ce.id = re.estado_id
                 order by ct.nombre, ce.nombre
                ";
//        $this->dbm->debug = true;
        $resultado = $this->dbm->Execute($sql);
        $resultado = $resultado->getRows();
        $res["resultado"] = $resultado;

//        print_struc($res);
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

        $sql = "select count(*) as total
                from icas.proyecto as p
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
            p.departamento_id, count(*) as total
            FROM icas.proyecto as p
            ".$where."
            group by p.departamento_id
            ) as dep
            left join geo.departamento as d on d.id = dep.departamento_id
            order by d.name";
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
                p.tipo_proyecto_id, count(*) as total
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