<?PHP
namespace App\Ccfs\Module\Ccfs_listado\Snippet\Ubicacion;
use Core\CoreResources;
class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }
    /**
     * Implementación desde aca
     */
    public function conf_catalog_form($item){
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
        }
        return $item;
    }


    public function confCatalog(){

        /*
        $this->addCatalogList($this->table["tipo_proyecto"]
            ,"tipo_proyecto","","nombre",""
            ,"nombre","","","");

        $this->addCatalogList($this->table["ejecutor"]
            ,"ejecutor","","nombre",""
            ,"nombre","","","");

        $this->addCatalogList($this->table["puebloindigena"]
            ,"puebloindigena","","nombre",""
            ,"nombre","","","");

        $this->addCatalogList($this->table["macroregion"]
            ,"macroregion","","nombre",""
            ,"nombre","","","");
        */
    }
}