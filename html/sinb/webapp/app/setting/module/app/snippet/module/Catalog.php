<?PHP
namespace App\Setting\Module\App\Snippet\Module;
use Core\CoreResources;
class Catalog extends CoreResources{

    function __construct(){
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }
    public function conf_catalog_table($item_id){

        $where = "app_id='".$item_id."' ";
        $this->addCatalogList($this->table["app_group"],"group","name","","","",$where,"","");
    }

    public function get_activo_option(){
        global $smarty;
        $dato = array();
        $dato["1"] = $smarty->config_vars["glOptActive"];
        $dato["0"] = $smarty->config_vars["glOptInactive"];
        return $dato;
    }


    public function get_tipo_option(){
        $dato = array();
        $dato["module"] = "Folder";
        $dato["url"] = "URL";
        return $dato;
    }


    public function conf_catalog_form($item_id){
        $where = "app_id='".$item_id."' ";
        $this->addCatalogList($this->table["app_group"],"group","","","","", $where,"","");
        //$this->addCatalogList($this->table["modulo"],"modulo","","titulo","","itemid","","");
    }





    public function get_item_options(){
        //$this->dbm->debug = true;
        $sql = "select 
                m.titulo , sb.itemId, sb.moduloId ,(SELECT sb2.nombre from ".$this->table["submodulo"]." as sb2
                where sb2.itemId = sb.parent) as grupo,sb.nombre, sb.carpeta, sb.parent
                from ".$this->table["submodulo"]." as sb
                left join ".$this->table["modulo"]."  as m on m.itemId = sb.moduloId
                where sb.parent!=0
                order by sb.moduloId, sb.parent
                ";

        $item = $this->dbm->Execute($sql)->GetRows();
        // print_struc($item);

        $res = array();
        foreach ($item as $row){
            $res[$row["titulo"]] [$row["itemId"]] = "Grupo: ".$row["grupo"]." | ".$row["nombre"]."";
        }
        return $res;
    }

}