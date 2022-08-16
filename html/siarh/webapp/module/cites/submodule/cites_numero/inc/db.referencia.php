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

/**
 * Tablas principales
 * -----------------------------------------------------------------------------------------------------------------
 */
$db_prefix = ""; //prefijo de la base de datos
$db_datos = array();
/**
 * Objeto ITEM
 */
$objdb = "registro";
$db_datos[] = $core->get_alias_campo($objdb,"","");
$db_prefix = $objdb."_";
$db_datos[] = $core->get_alias_campo($db_prefix."numero",$db_prefix,"");

$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"",$dbname,"",""));
unset($db_datos);
unset($db_prefix);
/**
 * Catalogos
 * -----------------------------------------------------------------------------------------------------------------
 */
$db_datos = array();
$db_datos[] = $core->get_alias_campo("estado_numero","","");

$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"c",$dbname,"",""));
unset($db_datos);
unset($db_prefix);
