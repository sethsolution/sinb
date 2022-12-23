<?PHP
namespace App\Cites\Module\Reportes_Cites\Snippet\Cites;
use Core\CoreResources;
class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog($item){

        $this->addCatalogList($this->table["cites_proposito"]
            ,"proposito","","nombre",""
            ,"nombre","","","");

        $this->addCatalogList($this->table["cites_tipo_documento"]
            ,"tipo_documento","","nombre",""
            ,"nombre","","","");

        $this->addCatalogList($this->table["cites_estado"]
            ,"estado","","nombre",""
            ,"nombre","","","");
    }

    function getConvenioOptions($id){
        /**
         * sacamos los convencios segun el tipo
         */
        if($id!="" and $id>0){
            $sql = "select * from ".$this->table["convenio"]." as sr where sr.tipo_id = '".$id."'";
            $item = $this->dbm->Execute($sql);
            $item = $item->GetRows();
        }
        return $item;
    }

    function getMunicipioOptions($id){
//        print_struc($id);exit();
        $id =  implode(",", (array) $id);
//        $id = "";
        /**
         * sacamos los municipio
         */
        if($id!=""){
            $sql = "select m.id,m.departamen, m.name 
                    from ".$this->table["municipio"]." as m where m.departamento_id in (".$id.") 
                    order by m.departamen
                    ";
            $item = $this->dbm->Execute($sql);
            $item = $item->GetRows();
        }
        return $item;
    }

    function getYearOptions(){
        /**
         * sacamos los anios
         */
            $sql = "Select EXTRACT(YEAR FROM c.fecha) as año 
                    FROM cites.cites as c
                    GROUP BY EXTRACT(YEAR FROM c.fecha)
                    ";
            $item = $this->dbm->Execute($sql);
            $item = $item->GetRows();
        $dato = array();
        foreach ($item as $row){
            $dato[$row["año"]] = $row["año"];
        }
        return $dato;
    }

}