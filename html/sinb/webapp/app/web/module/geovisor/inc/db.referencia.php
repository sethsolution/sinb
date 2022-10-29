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
$dbSchemaName = "public";
$db_table[] = Core::getTableConfig("proyecto");
$db_table[] = Core::getTableConfig("programa");
$db_table[] = Core::getTableConfig("programa_convenio");
$db_table[] = Core::getTableConfig("programa_sector");
$appVars["table"]  = Core::getDbTablesFromArray($db_table,$dbSchemaName);
unset($db_table);
unset($db_prefix);


$db_table = array();
$dbSchemaName = "catalogo";
$db_table[] = Core::getTableConfig("contraparte_responsable");
$db_table[] = Core::getTableConfig("convenio_vigencia");
$db_table[] = Core::getTableConfig("dificultad");
$db_table[] = Core::getTableConfig("ejecutor");
$db_table[] = Core::getTableConfig("estado");
$db_table[] = Core::getTableConfig("organismo_financiador_tipo");
$db_table[] = Core::getTableConfig("sector");
$db_table[] = Core::getTableConfig("tipo_proyecto");

$appVars["table"]  = Core::getDbTablesFromArray($db_table,$dbSchemaName,$appVars["table"] );
unset($db_table);

$db_table = array();
$dbSchemaName = "geo";
$db_table[] = Core::getTableConfig("departamento");
$db_table[] = Core::getTableConfig("municipio");
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
