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
$dbSchemaName = $dbSetting[0]["schema"];
$db_table[] = Core::getTableConfig("empresa");
$db_table[] = Core::getTableConfig("empresa_archivo");
$db_table[] = Core::getTableConfig("empresa_pago");
$appVars["table"]  = Core::getDbTablesFromArray($db_table,$dbSchemaName);
unset($db_table);
unset($db_prefix);

/**
 * Catalog
 */
$db_table = array();
$dbSchemaName = $dbSetting[0]["schema"];
$db_prefix = "catalogo_";
$db_table[] = Core::getTableConfig($db_prefix."empresa_tipo_pago",$db_prefix);
$db_table[] = Core::getTableConfig($db_prefix."empresa_tipo_actividad",$db_prefix);
$db_table[] = Core::getTableConfig($db_prefix."empresa_estado",$db_prefix);
$db_table[] = Core::getTableConfig($db_prefix."empresa_tipo_entidad",$db_prefix);

$db_table[] = Core::getTableConfig($db_prefix."departamento",$db_prefix);
$db_table[] = Core::getTableConfig($db_prefix."pais",$db_prefix);
$db_table[] = Core::getTableConfig($db_prefix."empresa_entidad_cientifica",$db_prefix);
$db_table[] = Core::getTableConfig($db_prefix."empresa_ocasional",$db_prefix);
$db_table[] = Core::getTableConfig($db_prefix."empresa_tipo",$db_prefix);

$db_table[] = Core::getTableConfig($db_prefix."empresa_tipo_requisito",$db_prefix);
$db_table[] = Core::getTableConfig($db_prefix."empresa_pago_estado",$db_prefix);
$db_table[] = Core::getTableConfig($db_prefix."requisito",$db_prefix);
$db_table[] = Core::getTableConfig($db_prefix."requisito",$db_prefix);
$db_table[] = Core::getTableConfig($db_prefix."categoria",$db_prefix);
$db_table[] = Core::getTableConfig($db_prefix."especie",$db_prefix);
$db_table[] = Core::getTableConfig($db_prefix."estado",$db_prefix);
$db_table[] = Core::getTableConfig($db_prefix."empresa_tipo_institucion",$db_prefix);
$appVars["table"]  = Core::getDbTablesFromArray($db_table,$dbSchemaName,$appVars["table"]);
unset($db_table);

/**
 * Base de usuarios CITES Público
 */
$db_table = array();
$dbSchemaName = $dbSetting[1]["schema"];
$db_table[] = Core::getTableConfig("usuario");
$appVars["table"]  = Core::getDbTablesFromArray($db_table,$dbSchemaName,$appVars["table"]);
unset($db_table);

/**
 * Otras base de datos
 */

/* /
print_struc($appVars["table"] );
print_struc($CFG->table);
exit;
/**/

