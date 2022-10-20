<?PHP
namespace App\Sinpreh\Module\Programa\Snippet\general;
use Core\CoreResources;

class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog(){
        $this->addCatalogList($this->table["programa_norma"]
            ,"programa_norma","","nombre",""
            ,"nombre","","","");

        $this->addCatalogList($this->table["programa_estado"]
            ,"programa_estado","","nombre",""
            ,"nombre","","","");
        $this->addCatalogList($this->table["moneda"]
            ,"moneda","","nombre",""
            ,"nombre","","","");
    }

}