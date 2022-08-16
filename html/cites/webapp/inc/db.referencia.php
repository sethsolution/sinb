<?
/**
 * Configuración de referencias de las tablas de las base de datos que utilizaremos todo el CORE
 *
 */
$CFG->tabla = array();
/**
 * Tablas de información principal, configuración de los objetos principales
 */

$db_prefix = ""; //prefijo de la base de datos
$dbname = $CFG->dbDatabase;
$db_datos = array();
$db_datos[] = $core->get_alias_campo("menu","","");
//$db_datos[] = $core->get_alias_campo($db_prefix."grupo",$db_prefix,"");
//$db_datos[] = $core->get_alias_campo($db_prefix."grupo_permisos",$db_prefix,"");
$db_datos[] = $core->get_alias_campo("logs","","");
$db_datos[] = $core->get_alias_campo("modulo","","");
$db_datos[] = $core->get_alias_campo("submodulo","","");
$db_datos[] = $core->get_alias_campo("usuario","","");
$db_datos[] = $core->get_alias_campo("usuario_permisos","","");
$db_datos[] = $core->get_alias_campo("config","","");

$CFG->tabla = array_merge($CFG->tabla,$core->get_tablas_from_array($db_datos,"",$dbname,"",""));
unset($db_datos);
unset($db_prefix);

$db_datos = array();
$db_prefix = "catalogo_"; //prefijo de la base de datos
$db_datos[] = $core->get_alias_campo("categoria","","");
$CFG->tabla = array_merge($CFG->tabla,$core->get_tablas_from_array($db_datos,"c",$dbname));
unset($db_datos);
unset($db_prefix);
//unset($dbname);

/**
 * Otras base de datos
 */
$dbname = $CFG->prefix."cites"; // otra base de datos que no es la principal
$db_datos = array();
$db_datos[] = "item";
$db_datos[] = $core->get_alias_campo("empresa","","");

$CFG->tabla = array_merge($CFG->tabla,$core->get_tablas_from_array($db_datos,"cites",$dbname));
unset($db_datos);
unset($dbname);
unset($db_prefix);


$core->cargar_tablas($CFG->tabla);
/* /
print_struc($CFG->tabla);
exit;
/**/
