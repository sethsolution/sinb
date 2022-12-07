<?PHP
namespace App\Icas\Module\Proyecto\Snippet\general;
use Core\CoreResources;

class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog(){
        $this->addCatalogList($this->table["icas_area"]
            ,"icas_area","","nombre",""
            ,"id","","","");

        $this->addCatalogList($this->table["icas_estado"]
            ,"icas_estado","","nombre",""
            ,"nombre","","","");

        $this->addCatalogList($this->table["icas_fuente_financiamiento"]
            ,"financiamiento","","nombre",""
            ,"id","","","");
        $where = "cod_dep<>'0'";
        $this->addCatalogList($this->table["departamento"]
            ,"departamento","","name",""
            ,"name",$where,"","");
    }

}