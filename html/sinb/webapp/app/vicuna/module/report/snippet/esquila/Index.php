<?PHP
namespace App\Vicuna\Module\Report\Snippet\Esquila;
use Core\CoreResources;
class Index extends CoreResources
{
    var $objTable = "institucion";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();

    }

    function getMunicipioTotal($municipio_id,$departamento_id){
        $sql = "select e.municipio, count(*) as total
                from esquila as e
                where e.departamento_id = ".$departamento_id." and p.municipio_id=".$municipio_id."
                GROUP BY e.municipio";
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
            $total = $total + (int)$row["total"];
        }
        $res["total"] = $total;

        /**
         * Sacamos los datos para la tabla
         */
        $sql = "select re.departamento_id, d.name as departamento, m.name as municipio, re.total
                from
                (
                select i.departamento_id, i.municipio_id, count(*) as total
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
         * Sacamos la lista de esquilas - actas
         */
        $sql = " SELECT i.id
      
, i.nacional_id
, i.anio
, d.name as departamento
, m.provincia as provincia
, m.name as municipio
, i.localidad
, i.arcmv
, i.cmv
, i.numero_acta
, i.sitio_captura
, to_char(i.fecha_captura, 'DD/MM/YYYY') as fecha_captura
    FROM vicuna.esquila i
        LEFT JOIN geo.departamento d ON d.id = i.departamento_id
        LEFT JOIN geo.municipio m ON m.id = i.municipio_id
        ".$where."
        ";
        $resultado = $this->dbm->Execute($sql);
        $resultado = $resultado->getRows();
        $res["esquilas"] = $resultado;
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
            i.departamento_id, count(*) as total
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