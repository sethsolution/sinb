<?
/**
 * Configuración de referncias de las tablas de las base de datos que utilizaremos todo el CORE
 *
 */
$CFG->tabla = array();
/**
 * Tablas de información principal, configuración de los objetos principales
 */

$db_prefix = "core_"; //prefijo de la base de datos
$db_datos = array();
$db_datos[] = $core->get_alias_campo("menu","","");
$db_datos[] = $core->get_alias_campo($db_prefix."grupo",$db_prefix,"");
$db_datos[] = $core->get_alias_campo($db_prefix."grupo_permisos",$db_prefix,"");
$db_datos[] = $core->get_alias_campo($db_prefix."logs",$db_prefix,"");
$db_datos[] = $core->get_alias_campo($db_prefix."modulo",$db_prefix,"");
$db_datos[] = $core->get_alias_campo($db_prefix."permisos_ficha_tecnicos",$db_prefix,"");
$db_datos[] = $core->get_alias_campo($db_prefix."submodulo",$db_prefix,"");
$db_datos[] = $core->get_alias_campo($db_prefix."usuario",$db_prefix,"");
$db_datos[] = $core->get_alias_campo($db_prefix."usuario_institucion",$db_prefix,"");
$db_datos[] = $core->get_alias_campo($db_prefix."usuario_permisos",$db_prefix,"");

$CFG->tabla = array_merge($CFG->tabla,$core->get_tablas_from_array($db_datos,"",$dbname,"",""));
unset($db_datos);
unset($db_prefix);

$db_datos = array();
$db_prefix = "catalogo_"; //prefijo de la base de datos
$db_datos[] = $core->get_alias_campo("categoria","","");
$CFG->tabla = array_merge($CFG->tabla,$core->get_tablas_from_array($db_datos,"c",""));
unset($db_datos);
unset($db_prefix);

/**
 * Otras base de datos
 */
$dbname = $CFG->prefix."vrhr_territorio"; // otra base de datos que no es la principal
$db_datos = array();
$db_datos[] = "departamento";
$db_datos[] = $core->get_alias_campo("departamento","","");

$CFG->tabla = array_merge($CFG->tabla,$core->get_tablas_from_array($db_datos,"o",$dbname));
unset($db_datos);
unset($dbname);
unset($db_prefix);


$dbname = $CFG->prefix."mmaya_personal"; // otra base de datos que no es la principal
$db_datos = array();
$db_datos[] = $core->get_alias_campo("persona","","");

$CFG->tabla = array_merge($CFG->tabla,$core->get_tablas_from_array($db_datos,"o",$dbname));
unset($db_datos);
unset($dbname);
unset($db_prefix);




$core->cargar_tablas($CFG->tabla);
/* /
print_struc($CFG->tabla);
exit;
/**/
