<?PHP
namespace App\Lagarto\Module\Institucion\Snippet\general;
use Core\CoreResources;

class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog(){
        $this->addCatalogList($this->table["lagarto_red"]
            ,"red","","nombre",""
            ,"id","","","");

        $this->addCatalogList($this->table["lagarto_actividad"]
            ,"actividad","","codigo",""
            ,"id","","","");

        $this->addCatalogList($this->table["departamento"]
            ,"departamento","","name",""
            ,"id","","","");
    }

}