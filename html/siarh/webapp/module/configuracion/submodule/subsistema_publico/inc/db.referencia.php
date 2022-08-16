<?php
/**
 * Configuración de referncias de las tablas de las base de datos que utilizaremos en este módulo
 *
 */
$CFGm->tabla = array();
/**
 * Tablas de información principal, configuración de los objetos principales
 */

/**
 * Tablas de información principal, configuración de los objetos principales}
 * Tipo = Vacio es tabla principa
 * Tipo = c --> es Catalogo
 * Tipo = o --> Otras tablas de otras bases de datos
 */


$db_prefix = ""; //prefijo de la base de datos
$db_datos = array();
$db_prefix = "";
$db_datos[] = $core->get_alias_campo("modulo",$db_prefix,"");
$db_datos[] = $core->get_alias_campo("submodulo",$db_prefix,"");
$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"",$dbname,"",""));
unset($db_datos);
unset($db_prefix);

/**/
$db_datos = array();
$db_datos[] = $core->get_alias_campo("categoria","","");
$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"c",$dbname,"",""));
unset($db_datos);
unset($db_prefix);
/**/
/**
 * Otras base de datos
 */

$dbname = "public_core"; // otra base de datos que no es la principal
$db_prefix= "";
$db_datos[] = $core->get_alias_campo($db_prefix."usuario",$db_prefix,"");
$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"o",$dbname));
unset($db_datos);
unset($dbname);
unset($db_prefix);

/* /
print_struc($CFGm->tabla);
print_struc($CFG->tabla);
exit;
/**/
