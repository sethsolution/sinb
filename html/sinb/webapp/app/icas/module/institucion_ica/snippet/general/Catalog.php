<?PHP
namespace App\Icas\InstitucionIca\general;
use Core\CoreResources;

class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog(){
        $this->addCatalogList($this->table["pais"]
            ,"pais","","nombre",""
            ,"nombre","","","");
//
//        $this->addCatalogList($this->table["programa_estado"]
//            ,"programa_estado","","nombre",""
//            ,"nombre","","","");
        $this->addCatalogList($this->table["departamento"]
            ,"departamento","","name",""
            ,"name","","","");
    }

}