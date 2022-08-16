<?php
/**
 * Añadimos Vendor generado con composer
 */

require_once './../vendor/autoload.php';
require_once("./inc/db.credencial.php");
require_once("./inc/config.php");
session_name($CFG->session_name);
session_start();
$_SESSION["start"] = time(); 
/* Si existe el ingreso de la variable action se crea */
if(isset($_REQUEST["action"])){
	$action = $_REQUEST["action"];
}else{
	$action = "";	
}

include_once("./inc/lib.php");
require_once("./inc/smarty.conf.php");
require_once("./inc/pentaho.conf.php");
require_once("./inc/db.php");
include_once("./lib/core/table.php");
include_once("./inc/mensajes_core.php");
/**
 * Objeto para manejo de estadísticas
 */
require_once("./lib/core/syslog.class.php");
global $statSys;
$sysLog = new SysLog;
//$statSys = new Statistics;
/**
 * Objeto de uso variado del core
 */
require_once("./lib/core/core.php");
$core = new core;
/**
 * referencia a tablas
 */
require_once("./inc/db.referencia.php");

/**
 * Objeto de list util para datatable
 */
require_once("./lib/core/class-list-util.php");

/**
 * Telegram
 */
include_once("./inc/telegram.php");

/**
 * google map
 */
include_once("./inc/googlemap.php");

/**
 * Servicios Api & birt
 */
include_once("./inc/servicios.php");

define('CHARSET','UTF-8');
header('Content-type: text/html; charset='.CHARSET);
