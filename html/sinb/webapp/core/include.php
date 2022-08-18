<?PHP
$starttime = time();
/**
 *
 */
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