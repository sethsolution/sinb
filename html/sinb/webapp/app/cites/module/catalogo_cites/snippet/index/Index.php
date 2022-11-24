<?PHP
namespace App\Cites\Module\Catalogo_cites\Snippet\Index;
use Core\CoreResources;

class Index extends CoreResources {
    var $objTable = "";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }
}