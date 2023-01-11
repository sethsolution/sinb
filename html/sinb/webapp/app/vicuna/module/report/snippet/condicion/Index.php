<?PHP
namespace App\Vicuna\Module\Report\Snippet\Condicion;
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
            $totalCMalo = $totalCMalo + (int)$row["total_cmalo"];
            $totalCRegular = $totalCRegular + (int)$row["total_cregular"];
            $totalCBueno = $totalCBueno + (int)$row["total_cbueno"];
            $totalGSi = $totalGSi + (int)$row["total_gsi"];
            $totalGNo = $totalGNo + (int)$row["total_gno"];
        }
        $res["totalCMalo"] = $totalCMalo;
        $res["totalCRegular"] = $totalCRegular;
        $res["totalCBueno"] = $totalCBueno;
        $res["totalGSi"] = $totalGSi;
        $res["totalGNo"] = $totalGNo;

        /**
         * Sacamos los datos para la tabla
         */
        $sql = "select re.departamento_id, d.name as departamento, m.name as municipio, re.total_cmalo, re.total_cregular, re.total_cbueno, total_gsi, total_gno
                from
                (
                select i.departamento_id, i.municipio_id,
                        sum(i.condicion_corporal_malo) as total_cmalo,  
                        sum(i.condicion_corporal_regular) as total_cregular, 
                        sum(i.condicion_corporal_bueno) as total_cbueno,
                        sum(i.gestacion_si) as total_gsi, 
                        sum(i.gestacion_no) as total_gno
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
            ,dep.total_cmalo, dep.total_cregular, dep.total_cbueno, dep.total_gsi, dep.total_gno
            from
            (
            SELECT  
            i.departamento_id, sum(i.condicion_corporal_malo) as total_cmalo,  
                   sum(i.condicion_corporal_regular) as total_cregular, sum(i.condicion_corporal_bueno) as total_cbueno,
                   sum(i.gestacion_si) as total_gsi, sum(i.gestacion_no) as total_gno
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