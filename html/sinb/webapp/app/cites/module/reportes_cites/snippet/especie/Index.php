<?PHP
namespace App\Cites\Module\Reportes_Cites\Snippet\Especie;
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

        if(isset($item["especie_id"])  and is_array($item["especie_id"])){
            $filtro =  implode(',',$item["especie_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "c.especie_id in (".$filtro.")  ";
        }

        if(isset($item["year"])  and is_array($item["year"])){
            $filtro =  implode(',',$item["year"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "EXTRACT(YEAR FROM cc.fecha) in (".$filtro.")  ";
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
         * Sacamos el rango de meses
         */
        $meses = $this->getMonths($filtro);
        $res["meses"] = $meses;
        /**
         * Sacamos primer totalizado por red (cuero, carne, ...)
         */
        $sql = "select
                CASE
                    WHEN ce.nombre is null THEN 'SIN REGISTRO'
                    ELSE ce.nombre
                  END  as especie
                ,
                    CASE
                    WHEN cc.especie_id is null THEN '0'
                    ELSE cc.especie_id
                  END
                 ,cc.total
                from
                (
                select c.especie_id ,count(*) as total
                from cites.cites_especie as c
                left join cites.cites as  cc on cc.id = c.cites_id
                ".$where."
                GROUP BY c.especie_id
                ) as cc
                left join catalogo.cites_especie as ce on ce.id= cc.especie_id
                order by ce.id
                ";
//        print_struc($sql);
        $especie = $this->dbm->Execute($sql);
        $especie = $especie->getRows();
        $res["especie"] = $especie;

        /**
         * Datos estado cites month
         */
        $mesEspecie = $this->getEspecieMonth($filtro,$meses);
        $res["mesEspecie"] = $mesEspecie;


        /**
         * Total de todos los instituciones
         */
        $total = 0;
        foreach ($especie as $row){
            $total = $total + (int)$row["total"];
        }
        $res["total"] = $total;

        return $res;
    }


    public function getEspecieMes($mes,$id,$where,$join){
        if($where == ""){
            $where .= " where ";
        }else{
            $where .= " and ";
        }
        $mes = $mes==""?"is null":"=".$mes;
        $where .= " EXTRACT(MONTH FROM cc.fecha) ".$mes;

        $id = $id==0?"is null":"=".$id;
        $where .= " and c.especie_id ".$id;

        $sql = "select count(*) as total
                from cites.cites_especie as c
                left join cites.cites as  cc on cc.id = c.cites_id
                ".$where." ";

        $dato = $this->dbm->Execute($sql);
        $dato = $dato->fields;
        $total = $dato["total"]==""?0:$dato["total"];
        return $total;
    }

    public function getEspecieMonth($filtro,$months){
        $where = $filtro["where"];
        $join = $filtro["join"];
        /**
         * Sacamos todos los tipos de proyectos, incluso los que no estan asignados
         */
        $sql = "select 
                CASE
                    WHEN es.nombre is null THEN 'SIN REGISTRO'
                    ELSE es.nombre
                  END  as especie
                ,
                    CASE
                    WHEN ce.especie_id is null THEN '0'
                    ELSE ce.especie_id
                  END  
                    
                ,ce.total
                from
                (
                select 
                c.especie_id, count(*) as total
                from cites.cites_especie as c
                left join cites.cites as  cc on cc.id = c.cites_id
                ".$where."
                group by c.especie_id
                ) as ce
                
                left join catalogo.cites_especie as  es on es.id = ce.especie_id";
        $especie_cites = $this->dbm->Execute($sql);
        $especie_cites = $especie_cites->getRows();

        /**
         * Recorremos todos los años
         */
        $dato = array();

        foreach ($months as  $key=> $row){
            $dato[$key]["mes"] = $row["mes"];
            $dato[$key]["nombre"] = $row["nombre"];
            foreach ($especie_cites as $k => $especie){
                $total = $this->getEspecieMes($row["mes"],$especie["especie_id"],$where,$join);
                $dato[$key]["especie"][]= array("especie"=>$especie["especie"],"id"=>$especie["especie_id"],"total"=>$total);
            }
        }

        $key ++;
        $dato[$key]["mes"] = "Sin Dato";
        foreach ($especie_cites as $k => $especie){
            $total = $this->getEspecieMes("",$especie["especie_id"],$where,$join);
            $dato[$key]["especie"][]= array("especie"=>$especie["especie"],"id"=>$especie["especie_id"],"total"=>$total);
        }
        //print_struc($dato);
        $res["especie"] = $especie_cites;
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
                select EXTRACT(MONTH FROM cc.fecha) as mes
                from cites.cites_especie as c
                left join cites.cites as  cc on cc.id = c.cites_id
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