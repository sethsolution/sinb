<?PHP
/**
 * Include
 * special application programming
 * Example include: include_once($appPath . "classes/ModuloCore.php");
 * $modulo_core = new ModuloCore();
 */

$action_path = APP_PATH."inc/action.path.php";
include_once($action_path);

$path_image = APP_PATH."template/images/";
$smarty->assign("path_image",$path_image);
