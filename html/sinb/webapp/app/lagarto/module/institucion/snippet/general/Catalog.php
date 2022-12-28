<?PHP
namespace App\Lagarto\Institucion\General;
use Core\CoreResources;

class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog(){
        $where = "cod_dep <> '0' ";
        $this->addCatalogList($this->table["departamento"]
            ,"departamento","","name",""
            ,"name",$where,"","");
        $this->addCatalogList($this->table["lagarto_red"]
            ,"red","","nombre",""
            ,"id","","","");

        $this->addCatalogList($this->table["lagarto_actividad"]
            ,"actividad","","codigo",""
            ,"id","","","");
    }

}