<?PHP
namespace App\Ccfs\Module\Catalogo_ccfs\Snippet\Index;
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