<?php
/**
 * Configuración de referncias de las tablas de las base de datos que utilizaremos en este módulo
 *
 */
$CFGm->tabla = array();
/**
 * Tablas de información principal, configuración de los objetos principales
 */

$db_prefix = ""; //prefijo de la base de datos
$db_datos = array();

$db_datos[] = $core->get_alias_campo("pais","","");
$db_datos[] = $core->get_alias_campo("tipo_documento","","");
$db_datos[] = $core->get_alias_campo("estado","","");

$db_datos[] = $core->get_alias_campo("tipo_proposito","","");
$db_datos[] = $core->get_alias_campo("tipo_entidad","","");

$db_datos[] = $core->get_alias_campo("cites_tipo_requisito","","");
$db_datos[] = $core->get_alias_campo("requisito","","");
$db_datos[] = $core->get_alias_campo("cites_tipo","","");

$db_datos[] = $core->get_alias_campo("empresa_pago_estado","","");
$db_datos[] = $core->get_alias_campo("categoria","","");

$db_datos[] = $core->get_alias_campo("especie","","");
$db_datos[] = $core->get_alias_campo("apendice","","");
$db_datos[] = $core->get_alias_campo("tipo_unidad","","");
$db_datos[] = $core->get_alias_campo("tipo_origen","","");
$db_datos[] = $core->get_alias_campo("puerto_embarque","","");

$db_datos[] = $core->get_alias_campo("estado_numero","","");

$db_datos[] = $core->get_alias_campo("sustitucion_tipo","","");
$db_datos[] = $core->get_alias_campo("sustitucion_causal","","");
$db_datos[] = $core->get_alias_campo("sustitucion_tipo_requisito","","");

$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"c",$dbname,"",""));
unset($db_datos);
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