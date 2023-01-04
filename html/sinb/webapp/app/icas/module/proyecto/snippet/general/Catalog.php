<?PHP
namespace App\Icas\Proyecto\general;
use Core\CoreResources;

class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog(){
        $where="active='1'";
        $this->addCatalogList($this->table["icas_area"]
            ,"icas_area","","nombre",""
            ,"id",$where,"","");

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