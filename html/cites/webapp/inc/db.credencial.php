<?PHP
/**
 * Conexión a la base de datos
 */
$dbType         = "mysqli";
$dbServer       = "sinb_mysql";
$dbUser         = "root";
$dbPassword     = "root";
$dbDatabase     = "cites_core";
//$prefix     = ""; //Prefijo de base de datos a ser utilizado, si que tuviera
$prefix     = "";
/* se añade el prefijo si tuviera */
$dbDatabase     = $prefix.$dbDatabase;
/**
 * Dirección donde se encuentra los archivos de sistema
 */
$dataFile = "./../dataFile/";