<?PHP
namespace App\Cites\Module\Cites_listado\Snippet\general;
use Core\CoreResources;

class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog(){
        $where = "active=true";
        $this->addCatalogList($this->table["cites_tipo_documento"]
            ,"tipo_documento","","nombre",""
            ,"id","$where","","");

        $this->addCatalogList($this->table["cites_proposito"]
            ,"proposito","","nombre",""
            ,"id","$where","","");
    }

}