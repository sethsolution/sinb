<?PHP
use Core\Core;
/**
 * Incluimos otros archivos adicionales si fuera necesario
 */

/**
 * Configuramos el directorio para este modulo
 * -----------------------------------------------------------------------------------
 */
/**
 * Verificamos y/o Creamos la carpeta padre
 */
$appVars["folderParent"] = "ccfs";
$appVars["directory"] = $_ENV['DATA_FILE'].$appVars["folderParent"]."/";
Core::createDirectory($appVars["directory"]);
/**
 *  Verificamos y/o Creamos la carpeta del módulo
 */
$appVars["folderModule"] = "ccfs_listado";
$appVars["directory"] = $appVars["directory"].$appVars["folderModule"]."/";
Core::createDirectory($appVars["directory"]);