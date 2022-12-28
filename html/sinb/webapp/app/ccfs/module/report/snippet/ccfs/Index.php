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
            $where .= "c.departamento_id in (".$filtro.")  ";
        }

        if(isset($item["municipio_id"])  and is_array($item["municipio_id"])){
            $filtro =  implode(',',$item["municipio_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "c.municipio_id in (".$filtro.")  ";
        }

        if(isset($item["categoria_id"])  and is_array($item["categoria_id"])){
            $filtro =  implode(',',$item["categoria_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "c.categoria_id in (".$filtro.")  ";
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
        $sql = "select cc.id , cc.nombre as categoria, re.total
                from
                (
                select c.categoria_id ,count(*) as total
                from ccfs.ccfs as c 
                ".$where."
                GROUP BY c.categoria_id
                ) as re
                left join catalogo.ccfs_categoria as cc on cc.id= re.categoria_id
                order by cc.nombre
                ";
        $categoria = $this->dbm->Execute($sql);
        $categoria = $categoria->getRows();
        $res["categoria"] = $categoria;
//        print_struc($res);

//        /**
//         * Sacamos todos los estado utilizados en esta consulta
//         */
//        $sql = "select ce.id, ce.nombre as estado ,t.*
//                    from(
//                    select p.estado_id, count(*) as total
//                    from icas.proyecto as p
//                    ".$where."
//                    GROUP BY p.estado_id
//                    ) as t
//                    left join catalogo.icas_estado as ce on ce.id = t.estado_id
//                ";
//        $estados = $this->dbm->Execute($sql);
//        $estados = $estados->getRows();;


        /**
         * Datos del departamento
         */
        $departamento = $this->getDepartamento($filtro);
        $res["departamento"] = $departamento;
//        print_struc($res["departamento"]);

        /**
         * recorremos los tipos y sacamos todos los estados encontrados
         */
//        $dato = array();
//        $cont = 0;
//        foreach ($estados as $row){
//            $dato[$cont]["id"] = $row["id"];
//            $dato[$cont]["nombre"] = $row["estado"];
//            foreach ($financiamiento as $es){
//                $totalItem = $this->getEstadoTotal($row["id"],$es["id"]);
//                $dato[$cont]["financiamiento"][] = array("nombre"=>$es["financiamiento"],"total"=>$totalItem);
//            }
//
//            $cont++;
//        }
//
//        $res["dato"] = $dato;

        /**
         * Total de todos los proyectos
         */
        $total = 0;
        foreach ($categoria as $row){
            $total = $total + (int)$row["total"];
        }
        $res["total"] = $total;
        /**
         * Sacamos los datos para la tabla
         */
        $sql = "select re.departamento_id, d.name as departamento, m.name as municipio, re.total
                from
                (
                select c.departamento_id, c.municipio_id, count(*) as total
                from ccfs.ccfs as c
                ".$where."
                GROUP BY c.departamento_id,c.municipio_id
                )
                as re
                left join geo.departamento as d on d.id= re.departamento_id
                left join geo.municipio as m on m.id = re.municipio_id
                 order by d.name, m.name
                ";
        $resultado = $this->dbm->Execute($sql);
        $resultado = $resultado->getRows();
        $res["resultado"] = $resultado;

        /**
         * Sacamos la lista de proyectos
         */
        $sql = " SELECT c.id
, c.nombre
, c.codigo
, cc.nombre as categoria
, c.condicion
, c.departamento
, c.provincia
, c.municipio
, c.licencia_funcionamiento
, c.formato
, c.responsable
    FROM ccfs.ccfs c
        LEFT JOIN catalogo.ccfs_categoria cc ON cc.id = c.categoria_id
        ".$where."
        ";
        $resultado = $this->dbm->Execute($sql);
        $resultado = $resultado->getRows();
        $res["ccfs"] = $resultado;
//        print_struc($res);

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
            c.departamento_id, count(*) as total
            FROM ccfs.ccfs as c
            ".$where."
            group by c.departamento_id
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