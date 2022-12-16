<?PHP
use Core\Core;
/**
 * Configuración de referncias de las tablas de las base de datos que utilizaremos en este módulo
 *
 */
$appVars["table"]  = array();
/**
 * Tablas de información principal, configuración de los objetos principales
 */

$db_prefix = ""; //prefijo de la base de datos
$db_table = array();
$dbSchemaName = "lagarto";
$db_table[] = Core::getTableConfig("institucion");
$db_table[] = Core::getTableConfig("institucion_actividad");
$db_table[] = Core::getTableConfig("institucion_archivo");
$db_table[] = Core::getTableConfig("institucion_cupo");
$db_table[] = Core::getTableConfig("institucion_inscripcion");
$db_table[] = Core::getTableConfig("gestion");
$appVars["table"]  = Core::getDbTablesFromArray($db_table,$dbSchemaName);
unset($db_table);
unset($db_prefix);

$db_table = array();
$dbSchemaName = "catalogo";
$db_table[] = Core::getTableConfig("lagarto_red");
$db_table[] = Core::getTableConfig("lagarto_actividad");
$appVars["table"]  = Core::getDbTablesFromArray($db_table,$dbSchemaName,$appVars["table"] );
unset($db_table);



$db_table = array();
$dbSchemaName = "geo";
$db_table[] = Core::getTableConfig("departamento");
$db_table[] = Core::getTableConfig("municipio");
$db_table[] = Core::getTableConfig("macroregion");
$appVars["table"]  = Core::getDbTablesFromArray($db_table,$dbSchemaName,$appVars["table"] );
unset($db_table);

/**
 * Otras base de datos
 */

/* /
print_struc($appVars["table"] );
print_struc($CFG->table);
exit;
/**/
