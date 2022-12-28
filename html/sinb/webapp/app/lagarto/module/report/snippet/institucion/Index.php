<?PHP
namespace App\Lagarto\Report\Institucion;
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

        if(isset($item["red_id"])  and is_array($item["red_id"])){
            $filtro =  implode(',',$item["red_id"]);
            if($where == ""){
                $where .= " where ";
            }else{
                $where .= " and ";
            }
            $where .= "i.red_id in (".$filtro.")  ";
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
         * Sacamos primer totalizado por red (cuero, carne, ...)
         */
        $sql = "select lr.id , lr.nombre as red, re.total
                from
                (
                select i.red_id ,count(*) as total
                from lagarto.institucion as i 
                ".$where."
                GROUP BY i.red_id
                ) as re
                left join catalogo.lagarto_red as lr on lr.id= re.red_id
                order by lr.nombre
                ";
        $red = $this->dbm->Execute($sql);
        $red = $red->getRows();
        $res["red"] = $red;

        /**
         * Datos del departamento
         */
        $departamento = $this->getDepartamento($filtro);
        $res["departamento"] = $departamento;

        /**
         * Total de todos los instituciones
         */
        $total = 0;
        foreach ($red as $row){
            $total = $total + (int)$row["total"];
        }
        $res["total"] = $total;

        /**
         * Sacamos la lista de instituciones
         */
        $sql = " SELECT i.id
, i.numero_registro
, i.nombre
, i.nit
, r.nombre as red
, d.name as departamento
, i.actividad
, i.representante_legal
, i.direccion
, i.telefono
, i.email
, to_char(i.fecha_inscripcion, 'DD/MM/YYYY') as fecha_inscripcion
, to_char(i.fecha_expiracion, 'DD/MM/YYYY') as fecha_expiracion
    FROM lagarto.institucion i
        LEFT JOIN catalogo.lagarto_red r ON r.id = i.red_id
        LEFT JOIN geo.departamento d ON d.id = i.departamento_id
        ".$where."
        ";
        $resultado = $this->dbm->Execute($sql);
        $resultado = $resultado->getRows();
        $res["instituciones"] = $resultado;

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
            FROM lagarto.institucion as i
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