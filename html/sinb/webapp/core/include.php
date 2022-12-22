<?PHP
$starttime = time();
/**
 *
 */

function err_handler ($errno, $errstr, $errfile, $errline) {
    global $display_errors;
    if(($errno != E_NOTICE && $errno != E_WARNING)&& $display_errors) {
        echo("<font face='Tahoma' size=2>
                <hr size=1 color=black>
                <b>Error [$errno]:      $errstr</b><br>
                File: ".basename($errfile)."<br>
                Line: $errline<br>
                <hr size=1 color=black>
                </font>");
    }
}
/**/
//===============================================================
//= Lineas que permite que la configuraci�n se php se encuentre =
//= en off para la variable global                              =
//===============================================================
/**/
$error_flags = E_ALL & ~E_NOTICE;
@error_reporting($error_flags);
@ini_set ('error_reporting', $error_flags);
$old_error_handler = set_error_handler("err_handler");
/**/
$phpver = phpversion();
$phpver = doubleval($phpver[0].".".$phpver[2]);
if($phpver >= 4.1) {
    extract($_POST,EXTR_SKIP);
    extract($_GET,EXTR_SKIP);
    extract($_SERVER,EXTR_SKIP);
    extract($_FILES);
    $ENV_COOKIE = $_COOKIE;
} else {
    function array_key_exists($key,&$array) {
        reset($array);
        while(list($k,$v) = each($array)) {
            if($k == $key) {
                reset($array);
                return true;
            }
        }
        reset($array);
        return false;
    }
    $ENV_COOKIE = $HTTP_COOKIE_VARS;
}

function print_struc($obj) {
    echo("<pre>");
    print_r($obj);
    echo("</pre>");
}
/**
 *
 */
$_ENV['APP_BASE_PATH'] = dirname(__DIR__);
define('BASE_PATH',realpath('.'));
const HOME_PATH = BASE_PATH . "/core/home/";
/**
 * Añadimos Vendor generado con composer
 */
require dirname(__DIR__).'/../vendor/autoload.php';
/**
 * Leemos las variables de entorno
 */
$dotenv = Dotenv\Dotenv::createImmutable('./../');
$dotenv->load();
/**
 * Configuramos las sessiones
 */
date_default_timezone_set($_ENV['TIME_ZONE']);
session_name($_ENV['APP_SESSION_NAME']);
session_start();
$_SESSION["start"] = $starttime;
/**
 * Cargamos clases necesarias
 */
require_once("./core/Core.php");
include_once("./core/CoreResources.php");
/**
 * Configuración de base de datos para ORM Elocuence
 */
require_once("./config/database.php");
/**
 * Configuración de Smarty
 */
include_once("./config/smarty.php");
/**
 * Por defecto configuramos la variable $action
 */
if(isset($_REQUEST["action"])){
	$action = $_REQUEST["action"];
}else{
	$action = "";	
}
/**
 * Cargamos los modelos de la aplicación principal
 */
foreach (glob("./app/Models/*.php") as $filename) {
    include $filename;
}
const CHARSET = 'UTF-8';
header('Content-type: text/html; charset='.CHARSET);