<?PHP
namespace App\Ilicito\Ilicito\General;
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

        $this->addCatalogList($this->table["ilicito_procedencia"]
            ,"procedencia","","nombre",""
            ,"nombre","","","");

        $this->addCatalogList($this->table["ccfs"]
            ,"destino","","nombre",""
            ,"nombre","","","");

        $this->addCatalogList($this->table["ilicito_categoria"]
            ,"categoria","","nombre",""
            ,"nombre","","","");

        $this->addCatalogList($this->table["ilicito_estado_salud"]
            ,"estado_salud","","nombre",""
            ,"nombre","","","");

        $this->addCatalogList($this->table["cites_especie"]
            ,"especie","","concat(nombre, '(', nombre_comun, ')') as nombre",""
            ,"nombre","","","1", "nombre");

    }

}