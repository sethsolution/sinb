<?php
/**
 * Configuración de referncias de las tablas de las base de datos que utilizaremos en este módulo
 *
 */
$CFGm->tabla = array();
/**
 * Objeto Empresa
 */
$objdb = "empresa";
$db_datos[] = $core->get_alias_campo($objdb,"","");
$db_prefix = $objdb."_";
$db_datos[] = $core->get_alias_campo($db_prefix."pago","","");
$db_datos[] = $core->get_alias_campo($db_prefix."archivo","","");
$db_datos[] = $core->get_alias_campo($db_prefix."mensaje",$db_prefix,"");

$db_datos[] = $core->get_alias_campo("cites",$db_prefix,"");
$db_datos[] = $core->get_alias_campo("dispensacion",$db_prefix,"");

$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"","","",""));
unset($db_datos);
unset($db_prefix);

/**
 * Catalagos a usar
 */
$db_datos = array();
$db_datos[] = $core->get_alias_campo("empresa_tipo_pago","","");
$db_datos[] = $core->get_alias_campo("empresa_tipo_actividad","","");
$db_datos[] = $core->get_alias_campo("empresa_estado","","");
$db_datos[] = $core->get_alias_campo("empresa_tipo_entidad","","");


$db_datos[] = $core->get_alias_campo("departamento","","");
$db_datos[] = $core->get_alias_campo("pais","","");
$db_datos[] = $core->get_alias_campo("empresa_entidad_cientifica","","");
$db_datos[] = $core->get_alias_campo("empresa_ocasional","","");
$db_datos[] = $core->get_alias_campo("empresa_tipo","","");

$db_datos[] = $core->get_alias_campo("empresa_tipo_requisito","","");
$db_datos[] = $core->get_alias_campo("requisito","","");
$db_datos[] = $core->get_alias_campo("requisito","","");
$db_datos[] = $core->get_alias_campo("categoria","","");
$db_datos[] = $core->get_alias_campo("especie","","");


$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"c","","",""));
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