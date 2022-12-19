<?PHP
namespace App\Vicuna\Module\Esquila\Snippet\general;
use Core\CoreResources;

class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog($item){
        $where = "cod_dep <> '0' ";
        $this->addCatalogList($this->table["departamento"]
            ,"departamento","","name",""
            ,"name",$where,"","");
        $where = $item["departamento_id"] != ""?" departamento_id = ".$item["departamento_id"]:"";
        $this->addCatalogList($this->table["municipio"]
            ,"municipio","","name",""
            ,"name",$where,"","");
    }

    function getMunicipioOptions($id){
        /**
         * sacamos los municipios
         */
        if($id!="" and $id>0){
            $sql = "select id,sec_prov,provincia,name,zona,id_ut,capital,cod_ut,ine_dpto,ine_prov,ine_mun from ".$this->table["municipio"]." as m where m.departamento_id = '".$id."'";
            $item = $this->dbm->Execute($sql);
            $item = $item->GetRows();
            //echo "entre al if";
        }
        return $item;
    }

}