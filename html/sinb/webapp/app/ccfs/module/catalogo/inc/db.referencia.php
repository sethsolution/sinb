<?php
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
$dbSchemaName = "catalogo";
$db_table[] = Core::getTableConfig("icas_area");

$appVars["table"]  = Core::getDbTablesFromArray($db_table,$dbSchemaName);
unset($db_table);
unset($db_prefix);

/**
 * Otras base de datos
 */
//$dbname = $CFG->prefix."vrhr_territorio"; // otra base de datos que no es la principal
//$db_datos = array();
//$db_datos[] = $core->get_alias_campo("departamento","","");
//$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"o",$dbname));
//unset($db_datos);
//unset($dbname);
//unset($db_prefix);
//

/* *
print_struc($CFGm->tabla);
print_struc($CFG->tabla);
exit;
/**/