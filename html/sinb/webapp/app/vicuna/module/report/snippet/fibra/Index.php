<?PHP
namespace App\Vicuna\Module\Report\Snippet\Fibra;
use Core\CoreResources;
class Index extends CoreResources
{
    var $objTable = "esquila";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();

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
            $where .= "i.departamento_id in (".$filtro.")  ";
        }

        if(isset($item["municipio_id"])  and is_array($item["municipio_id"])){
            $filtro =  implode(',',$item["municipio_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "i.municipio_id in (".$filtro.")  ";
        }
        if(isset($item["year"])  and is_array($item["year"])){
            $filtro =  implode(',',$item["year"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "i.anio in (".$filtro.")  ";
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
         * Datos del departamento
         */
        $departamento = $this->getDepartamento($filtro);
        $res["departamento"] = $departamento;

        /**
         * Total de todos las esquilas
         */
        $total = 0;
        foreach ($departamento as $row){
            $totalPredescerdada = $totalPredescerdada + (int)$row["total_venta_fibra_predescerdada"];
            $totalVellon = $totalVellon + (int)$row["total_venta_fibra_vellon"];
            $totalBraga = $totalBraga + (int)$row["total_venta_fibra_braga"];
            $totalIngresoPredescerdada = $totalIngresoPredescerdada + (int)$row["total_ingreso_predescerdada"];
            $totalIngresoVellon = $totalIngresoVellon + (int)$row["total_ingreso_vellon"];
            $totalIngresoBraga = $totalIngresoBraga + (int)$row["total_ingreso_braga"];
        }
        $res["totalPredescerdada"] = $totalPredescerdada;
        $res["totalVellon"] = $totalVellon;
        $res["totalBraga"] = $totalBraga;
        $res["totalIngresoPredescerdada"] = $totalIngresoPredescerdada;
        $res["totalIngresoVellon"] = $totalIngresoVellon;
        $res["totalIngresoBraga"] = $totalIngresoBraga;

        /**
         * Sacamos los datos para la tabla
         */
        $sql = "select re.departamento_id, d.name as departamento, m.name as municipio, 
                        re.total_venta_fibra_predescerdada, re.total_venta_fibra_vellon, re.total_venta_fibra_braga, re.total_ingreso_predescerdada, re.total_ingreso_vellon, total_ingreso_braga
                from
                (
                select i.departamento_id, i.municipio_id,
                    sum(i.venta_fibra_predescerdada) as total_venta_fibra_predescerdada,  
                   sum(i.venta_fibra_vellon) as total_venta_fibra_vellon, 
                   sum(i.venta_fibra_braga) as total_venta_fibra_braga,
                   sum(i.precio_venta_fibra_predescerdada*i.venta_fibra_predescerdada) as total_ingreso_predescerdada,
                   sum(i.precio_venta_fibra_vellon*i.venta_fibra_vellon) as total_ingreso_vellon,
                   sum(i.precio_venta_fibra_braga*i.venta_fibra_braga) as total_ingreso_braga
                from vicuna.esquila as i
                ".$where."
                GROUP BY i.departamento_id,i.municipio_id
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
         * Sacamos los datos para la segunda tabla
         */
        $sql = "select re.anio, re.total_ingreso_predescerdada, re.total_ingreso_vellon, re.total_ingreso_braga
                from
                (
                select i.anio as anio, 
                    sum(i.precio_venta_fibra_predescerdada*i.venta_fibra_predescerdada) as total_ingreso_predescerdada,
                   sum(i.precio_venta_fibra_vellon*i.venta_fibra_vellon) as total_ingreso_vellon,
                   sum(i.precio_venta_fibra_braga*i.venta_fibra_braga) as total_ingreso_braga
                from vicuna.esquila as i
                ".$where."
                GROUP BY i.anio
                )
                as re
                order by re.anio
                ";
        $ingreso = $this->dbm->Execute($sql);
        $ingreso = $ingreso->getRows();
        $res["ingreso"] = $ingreso;
//        print_struc($res["ingreso"]);

        /**
         * recorremos los anios y sacamos todos las fibras encontrados
         */
//        $fibras = array("Ingreso fibra predescerdada", "Ingreso fibra vellon", "Ingreso fibra braga");
//        $dato = array();
//        $cont = 0;
//        foreach ($fibras as $i){
//            $dato[$cont]["fibra"] = $i;
//            foreach ($ingreso as $row) {
//                //                $totalItem = $this->getFibraTotal($row["anio"]);
//                $dato[$cont]["anio"][] = array("anio" => $row['anio'], "total_predescerdada" => $row['total_ingreso_predescerdada'], "total_vellon" => $row['total_ingreso_vellon'], "total_braga" => $row['total_ingreso_braga']);
//            }
//
//            $cont++;
//        }
//        $res["dato"] = $dato;

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
            ,dep.total_venta_fibra_predescerdada, dep.total_venta_fibra_vellon, dep.total_venta_fibra_braga
            , dep.total_ingreso_predescerdada, dep.total_ingreso_vellon, dep.total_ingreso_braga
            from
            (
            SELECT  
            i.departamento_id, 
                   sum(i.venta_fibra_predescerdada) as total_venta_fibra_predescerdada,  
                   sum(i.venta_fibra_vellon) as total_venta_fibra_vellon, 
                   sum(i.venta_fibra_braga) as total_venta_fibra_braga,
                   sum(i.precio_venta_fibra_predescerdada*i.venta_fibra_predescerdada) as total_ingreso_predescerdada,
                   sum(i.precio_venta_fibra_vellon*i.venta_fibra_vellon) as total_ingreso_vellon,
                   sum(i.precio_venta_fibra_braga*i.venta_fibra_braga) as total_ingreso_braga
            FROM vicuna.esquila as i
            ".$where."
            group by i.departamento_id
            ) as dep
            left join geo.departamento as d on d.id = dep.departamento_id
            order by d.name";
        $data = $this->dbm->Execute($sql);
        $data = $data->getRows();
        return $data;
    }

}