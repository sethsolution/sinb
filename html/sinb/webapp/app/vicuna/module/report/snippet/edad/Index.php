<?PHP
namespace App\Vicuna\Module\Report\Snippet\Edad;
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
            $totalCrias = $totalCrias + (int)$row["total_crias"];
            $totalJuvenil = $totalJuvenil + (int)$row["total_juvenil"];
            $totalAdulto = $totalAdulto + (int)$row["total_adulto"];
        }
        $res["totalCrias"] = $totalCrias;
        $res["totalJuvenil"] = $totalJuvenil;
        $res["totalAdulto"] = $totalAdulto;

        /**
         * Sacamos los datos para la tabla
         */
        $sql = "select re.departamento_id, d.name as departamento, m.name as municipio, re.total_crias, re.total_juvenil, re.total_adulto
                from
                (
                select i.departamento_id, i.municipio_id, sum(i.edad_cria) as total_crias,  
                   sum(i.edad_juvenil) as total_juvenil, sum(i.edad_adulto) as total_adulto
                       
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
            ,dep.total_crias, dep.total_juvenil, dep.total_adulto
            from
            (
            SELECT  
            i.departamento_id, sum(i.edad_cria) as total_crias,  
                   sum(i.edad_juvenil) as total_juvenil, sum(i.edad_adulto) as total_adulto
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