<?PHP
/**
 * start of the information system
 */
include ("./core/include.php");

/**
 * calculates the elapsed time between the current time and the time recorded in session
 */
$time = intval(( time()-$_SESSION["start"]) / 60);

/**
 * Inicio de la aplicación
 */
include_once(HOME_PATH."sisweb.php");