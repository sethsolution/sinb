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

/**
 * Tablas de información principal, configuración de los objetos principales
 */
$db_prefix = ""; //prefijo de la base de datos
$db_datos = array();

/**
 * Objeto Empres
 */
$objdb = "empresa";
$db_datos[] = $core->get_alias_campo($objdb,"","");
$db_prefix = $objdb."_";
$db_datos[] = $core->get_alias_campo($db_prefix."pago","","");

$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"",$dbname,"",""));
unset($db_datos);
unset($db_prefix);
/**
 * Catalagos a usar
 */
$db_datos = array();
$db_datos[] = $core->get_alias_campo("pais","","");
$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"c",$dbname,"",""));
unset($db_datos);
unset($db_prefix);
/**
 * Otras base de datos
 * ------------------------------------------------------------------------------------------------
 */

$dbname = $CFG->dbDatabase;
$db_prefix= "core_";
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
