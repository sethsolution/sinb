<?PHP
/**
 * Include
 * special application programming
 * Example include: include_once($appPath . "classes/ModuloCore.php");
 * $modulo_core = new ModuloCore();
 */

$action_path = APP_PATH."inc/action.path.php";
include_once($action_path);

$configure = APP_PATH."inc/configure.php";
if(!is_file($configure)) {
    echo "<div style='background:#fffdf7;text-align:center;font-size:17px;padding: 10px;border:1px solid #dd7272;'><span style='color:red;font-family: Arial;'><strong>[ ERROR CONFIGURE ]</strong><br> You do not have configured the app's $configure file</span></div>";
    exit;
}
include_once($configure);