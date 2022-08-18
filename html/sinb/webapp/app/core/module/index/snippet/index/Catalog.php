<?PHP
namespace App\Core\Module\Index\Snippet\Index;
use Core\CoreResources;
class Catalog extends CoreResources{
    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }
}