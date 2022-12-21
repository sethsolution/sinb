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
$dbSchemaName = "icas";
$db_table[] = Core::getTableConfig("institucion");
$db_table[] = Core::getTableConfig("institucion_archivo");
$db_table[] = Core::getTableConfig("proyecto");
$db_table[] = Core::getTableConfig("proyecto_archivo");
$db_table[] = Core::getTableConfig("proyecto_institucion");
$appVars["table"]  = Core::getDbTablesFromArray($db_table,$dbSchemaName);
unset($db_table);
unset($db_prefix);

$db_table = array();
$dbSchemaName = "catalogo";
$db_table[] = Core::getTableConfig("icas_area");
$db_table[] = Core::getTableConfig("icas_estado");
$db_table[] = Core::getTableConfig("icas_fuente_financiamiento");
$db_table[] = Core::getTableConfig("icas_institucion_tipo");
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
