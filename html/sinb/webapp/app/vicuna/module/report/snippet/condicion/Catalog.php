<?PHP
namespace App\Vicuna\Module\Report\Snippet\Vicunas;
use Core\CoreResources;
class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog($item){

        $where = "cod_dep<>'0'";
        $this->addCatalogList($this->table["departamento"]
            ,"departamento","","name",""
            ,"name",$where,"","");
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
         * sacamos los convenio segun el programa
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

}