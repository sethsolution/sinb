<?PHP
use Core\Core;
/**
 * Definimos las variables de la app, sacadas de la URL
 * --------------------------------------------------------------------------------------------------------------
 */
$app_vars = core::getRouteVars();

define('APP',$app_vars["app"]);
define('APP_MODULE',$app_vars["module"]);
define('APP_CORE_ID',$app_vars["core_id"]);
define('APP_ROUTE_ACTION',$app_vars["route_action"]);
define('APP_ROUTE_ACTION',$app_vars["route_action"]);
define('APP_VARS',$app_vars["vars"]);
/**
 * Variable Accion por defecto
 */
$accion  = (isset($_REQUEST["accion"]))?$_REQUEST["accion"]:'';
/**
 * Definimos el path de la aplicación
 * --------------------------------------------------------------------------------------------------------------
 */
define('APP_PATH',"./app/" . APP . "/");

/**
 * Verificamos si una aplicación existe y se encuentra en la base de datos
 */
$appOk = 0;
$appAuth = 0;
/**
 * Sacamos los datos del subsistema que estamos accediendo
 */
$appOk = Core::getAppOk(APP);

switch ($appOk){
    case '0': include(HOME_PATH."nomodule.php"); break;
    case '2': include(HOME_PATH."noprivileges.php"); break;
}

if($appOk==1){
    /**
     * Cargamos las librerias de la app
     */
    include_once(APP_PATH."inc/template.php");
    include_once(APP_PATH."inc/inc.php");
    /**
     * Variables base de Smarty
     * --------------------------------------------------------------------------------------------------------------
     */
    $smarty->assign("app", APP);
    $smarty->assign("module", APP_MODULE);

    $getModule = "/".APP."/".APP_MODULE."/?";
    $smarty->assign("getModule", $getModule);

    $smarty->assign("userInfo", $_SESSION["userv"]);
    /**
     * Sacamos los datos del Submódulo
     */
    $miga = Core::getAppMigaData(APP,APP_MODULE);
    $smarty->assign("miga",$miga);

    include(HOME_PATH."app.php");
}
/**
 * calcula el tiempo de procesamiento
 */
$total_time =  time()-$_SESSION["start"];
$smarty->assign("total_time",$total_time);