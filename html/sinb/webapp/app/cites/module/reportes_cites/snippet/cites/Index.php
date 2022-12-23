<?PHP
namespace App\Cites\Module\Reportes_Cites\Snippet\Cites;
use Core\CoreResources;
class Index extends CoreResources
{
    var $objTable = "cites";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();

    }

    function get_filtro_where($item){
        $where = "";

        if(isset($item["tipo_documento_id"])  and is_array($item["tipo_documento_id"])){
            $filtro =  implode(',',$item["tipo_documento_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "c.tipo_documento_id in (".$filtro.")  ";
        }

        if(isset($item["proposito_id"])  and is_array($item["proposito_id"])){
            $filtro =  implode(',',$item["proposito_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "c.proposito_id in (".$filtro.")  ";
        }

        if(isset($item["estado_id"])  and is_array($item["estado_id"])){
            $filtro =  implode(',',$item["estado_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "c.estado_id in (".$filtro.")  ";
        }

        if(isset($item["year"])  and is_array($item["year"])){
            $filtro =  implode(',',$item["year"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "EXTRACT(YEAR FROM c.fecha) in (".$filtro.")  ";
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
         * Sacamos el rango de años
         */
        $years = $this->getYears($filtro);
        $res["years"] = $years;

        /**
         * Sacamos el rango de meses
         */
        $meses = $this->getMonths($filtro);
        $res["meses"] = $meses;
//        print_struc($res["months"]);
        /**
         * Sacamos primer totalizado por red (cuero, carne, ...)
         */
        $sql = "select ce.id , ce.nombre as estado, cc.total
                from
                (
                select c.estado_id ,count(*) as total
                from cites.cites as c 
                ".$where."
                GROUP BY c.estado_id
                ) as cc
                left join catalogo.cites_estado as ce on ce.id= cc.estado_id
                order by ce.id
                ";
        $estado = $this->dbm->Execute($sql);
        $estado = $estado->getRows();
        $res["estado"] = $estado;
//        print_struc($res);

        /**
         * Datos estado cites year
         */
        $estadoCites = $this->getCitesEstado($filtro,$years);
        $res["estadoCites"] = $estadoCites;

        /**
         * Datos estado cites month
         */
        $mesCites = $this->getCitesMonth($filtro,$meses);
        $res["mesCites"] = $mesCites;


        /**
         * Total de todos los instituciones
         */
        $total = 0;
        foreach ($estado as $row){
            $total = $total + (int)$row["total"];
        }
        $res["total"] = $total;

        /**
         * Sacamos la lista de esquilas - actas
         */
        $sql = " SELECT c.id
, to_char(c.fecha, 'DD/MM/YYYY') as fecha
, td.nombre as tipo_documento
, c.numero_cites
, c.exportador
, c.destinatario
, cp.nombre as proposito
, to_char(c.fecha_valido, 'DD/MM/YYYY') as fecha_valido
, ce.nombre as estado      
, c.observacion
    FROM cites.cites c
        LEFT JOIN catalogo.cites_tipo_documento td ON td.id = c.tipo_documento_id
        LEFT JOIN catalogo.cites_proposito cp ON cp.id = c.proposito_id
        LEFT JOIN catalogo.cites_estado ce ON ce.id = c.estado_id
        ".$where."
        ";
        $resultado = $this->dbm->Execute($sql);
        $resultado = $resultado->getRows();
        $res["esquilas"] = $resultado;

        return $res;
    }

    public function getEstadoYear($year,$id,$where,$join){
        if($where == ""){
            $where .= " where ";
        }else{
            $where .= " and ";
        }
        $year = $year==""?"is null":"=".$year;
        $where .= " EXTRACT(YEAR FROM c.fecha) ".$year;

        $id = $id==0?"is null":"=".$id;
        $where .= " and c.estado_id ".$id;

        $sql = "select count(*) as total
                from cites.cites as c
                ".$where." ";

        $dato = $this->dbm->Execute($sql);
        $dato = $dato->fields;
        $total = $dato["total"]==""?0:$dato["total"];
        return $total;
    }

    public function getEstadoMes($mes,$id,$where,$join){
        if($where == ""){
            $where .= " where ";
        }else{
            $where .= " and ";
        }
        $mes = $mes==""?"is null":"=".$mes;
        $where .= " EXTRACT(MONTH FROM c.fecha) ".$mes;

        $id = $id==0?"is null":"=".$id;
        $where .= " and c.estado_id ".$id;

        $sql = "select count(*) as total
                from cites.cites as c
                ".$where." ";

        $dato = $this->dbm->Execute($sql);
        $dato = $dato->fields;
        $total = $dato["total"]==""?0:$dato["total"];
        return $total;
    }

    public function getCitesEstado($filtro,$years){
        $where = $filtro["where"];
        $join = $filtro["join"];
        /**
         * Sacamos todos los tipos de proyectos, incluso los que no estan asignados
         */
        $sql = "select 
                CASE
                    WHEN ce.nombre is null THEN 'SIN REGISTRO'
                    ELSE ce.nombre
                  END  as estado
                ,
                    CASE
                    WHEN pe.estado_id is null THEN '0'
                    ELSE pe.estado_id
                  END  
                    
                ,pe.total
                from
                (
                select 
                c.estado_id, count(*) as total
                from cites.cites as c
                ".$where."
                group by c.estado_id
                ) as pe
                
                left join catalogo.cites_estado as  ce on ce.id = pe.estado_id";
        $estado_proyecto = $this->dbm->Execute($sql);
        $estado_proyecto = $estado_proyecto->getRows();

        /**
         * Recorremos todos los años
         */
        $dato = array();

        foreach ($estado_proyecto as  $key=> $row){
            $dato[$key]["estado"] = $row["estado"];
            foreach ($years as $k => $year){
                $total = $this->getEstadoYear($year["year"],$row["estado_id"],$where,$join);
                $dato[$key]["year"][]= array("year"=>$year["year"],"total"=>$total);
            }
        }

        $res["years"] = $years;
        $res["estados"] = $estado_proyecto;
        $res["citesEstado"] = $dato;
//        print_struc($res);
        return $res;
    }

    public function getYears($filtro){
        $where = $filtro["where"];
        $join = $filtro["join"];
        $sql = "select 
                CASE
                    WHEN re.year is null THEN '0'
                    ELSE re.year
                  END  as year
                ,re.total
                from
                (
                select EXTRACT(YEAR FROM c.fecha) as year, count(*) as total
                from cites.cites as c
                ".$where."
                GROUP BY year
                )
                as re
                order by re.year
			    ";
        $year_cite= $this->dbm->Execute($sql);
        $year_cite = $year_cite->getRows();
        return $year_cite;
    }

    public function getCitesMonth($filtro,$months){
        $where = $filtro["where"];
        $join = $filtro["join"];
        /**
         * Sacamos todos los tipos de proyectos, incluso los que no estan asignados
         */
        $sql = "select 
                CASE
                    WHEN cc.nombre is null THEN 'SIN REGISTRO'
                    ELSE cc.nombre
                  END  as estado
                ,
                    CASE
                    WHEN ce.estado_id is null THEN '0'
                    ELSE ce.estado_id
                  END  
                    
                ,ce.total
                from
                (
                select 
                c.estado_id, count(*) as total
                from cites.cites as c
                ".$where."
                group by c.estado_id
                ) as ce
                
                left join catalogo.cites_estado as  cc on cc.id = ce.estado_id";
        $estado_cites = $this->dbm->Execute($sql);
        $estado_cites = $estado_cites->getRows();

        /**
         * Recorremos todos los años
         */
        $dato = array();

        foreach ($months as  $key=> $row){
            $dato[$key]["mes"] = $row["mes"];
            $dato[$key]["nombre"] = $row["nombre"];
            foreach ($estado_cites as $k => $estado){
                $total = $this->getEstadoMes($row["mes"],$estado["estado_id"],$where,$join);
                $dato[$key]["estado"][]= array("estado"=>$estado["estado"],"id"=>$estado["estado_id"],"total"=>$total);
            }
        }

        $key ++;
        $dato[$key]["mes"] = "Sin Dato";
        foreach ($estado_cites as $k => $estado){
            $total = $this->getEstadoMes("",$estado["estado_id"],$where,$join);
            $dato[$key]["estado"][]= array("estado"=>$estado["estado"],"id"=>$estado["estado_id"],"total"=>$total);
        }
        //print_struc($dato);
        $res["estado"] = $estado_cites;
        $res["meses"] = $dato;
//        print_struc($res);
        return $res;
    }

    public function getMonths($filtro){
        $where = $filtro["where"];
        $join = $filtro["join"];
        $sql = "select re.mes as mes
                from
                (
                select EXTRACT(MONTH FROM c.fecha) as mes
                from cites.cites as c
                ".$where."
                GROUP BY mes
                )
                as re
                order by re.mes";
        $meses= $this->dbm->Execute($sql);
        $meses = $meses->getRows();
        foreach ($meses as  $key=> $row) {
            $dato[$key]["mes"] = $row["mes"];
            $dato[$key]["nombre"] = date("F", mktime(null, null, null, $row["mes"], 1));
        }
//        print_struc($dato);
        return $dato;
    }

}