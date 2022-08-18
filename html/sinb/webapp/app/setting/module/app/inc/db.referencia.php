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
$dbSchemaName = $coreDB["schema"];
$db_table[] = Core::getTableConfig("app");
$db_table[] = Core::getTableConfig("app_group");
$db_table[] = Core::getTableConfig("app_module");
$db_table[] = Core::getTableConfig("config");
$db_table[] = Core::getTableConfig("group");
$db_table[] = Core::getTableConfig("logs");
$db_table[] = Core::getTableConfig("user");
$db_table[] = Core::getTableConfig("user_module");

$appVars["table"]  = Core::getDbTablesFromArray($db_table,$dbSchemaName);
unset($db_table);
unset($db_prefix);
/**
 * Otras base de datos
 */

/* /
print_struc($appVars["table"] );
print_struc($CFG->table);
exit;
/**/
