<?PHP
namespace App\Agrobiodiversidad\Siarh\Index;
use Core\CoreResources;

class Index extends CoreResources {
    var $objTable = "proyecto";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }

}