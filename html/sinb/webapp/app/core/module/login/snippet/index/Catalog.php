<?PHP
namespace App\Core\Module\Login\Snippet\Index;
use Core\CoreResources;
class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    /**
     * Catalogo::configCatalogList()
     *
     * configura el arreglo de tablas de donde sacara los catalogos,
     * utilizando el metodo addCatalogList de la clase padres
     *
     * parametros: Tabla, id, dato, noutf8, orden
     *
     * si tuviera que sacar datos de una tabla que se encuentra en otra
     * base de datos se utilizara:   base_de_datos.Tabla
     *
     * como ayuda para sacar la lista de tablas,
     * se puede utilizar la funcion sql en mysql
     *
     * "show tables"
     *
     * @return void
     */
    public function conf_catalog_datos_general(){
        $this->addCatalogList($this->table["c_ip_publica"],"ippublica","","ip","","","","");
        $this->addCatalogList($this->table["c_lugar"],"lugar","nombre","","","","","");
        $this->addCatalogList($this->table["c_proveedor"],"proveedor","nombre","","","","","");
    }

}