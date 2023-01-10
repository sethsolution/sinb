<?PHP
namespace App\Icas\Module\Institucion\Snippet\adjunto;
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
        $where = $item["tipo_id"] != ""?" tipo_id = ".$item["tipo_id"]:"";
        $this->addCatalogList($this->table["institucion"]
            ,"institucion","","nombre",""
            ,"nombre",$where,"","");

        $this->addCatalogList($this->table["icas_institucion_tipo"]
            ,"icas_institucion_tipo","","nombre",""
            ,"nombre","","","");

    }
    public function get_activo_option(){
        global $smarty;
        $dato = array();
        $dato["1"] = $smarty->config_vars["glOptActive"];
        $dato["0"] = $smarty->config_vars["glOptInactive"];
        return $dato;
    }
    function getInstitucionOptions($id){
        /**
         * sacamos los municipios
         */
        if($id!="" and $id>0){
            $sql = "select id,nombre from ".$this->table["institucion"]." as i where i.tipo_id = '".$id."' ORDER BY nombre";
            $item = $this->dbm->Execute($sql);
            $item = $item->GetRows();
        }
        return $item;
    }

    function getInstitucion($id){
        /**
         * sacamos la intitucion
         */
        if($id!="" and $id>0){
            $sql = "select * from ".$this->table["institucion"]." as i where i.id = '".$id."'";
            $item = $this->dbm->Execute($sql);
            $item = $item->GetRows();
        }
        return $item;
    }
}