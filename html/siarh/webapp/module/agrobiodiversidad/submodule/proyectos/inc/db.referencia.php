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
 * Tablas de información principal, configuración de los objetos principales
 */
//prefijo de la base de datos
$db_prefix = "";
$db_datos = array();
$db_datos[] = $core->get_alias_campo("proyectos",$db_prefix,"");
$db_datos[] = $core->get_alias_campo("proyecto_deptos",$db_prefix,"");
$db_datos[] = $core->get_alias_campo("proyecto_municipios",$db_prefix,"");
$db_datos[] = $core->get_alias_campo("proyecto_financiamiento",$db_prefix,"");
$db_datos[] = $core->get_alias_campo("proyecto_componentes",$db_prefix,"");
$db_datos[] = $core->get_alias_campo("proyecto_contrapartes",$db_prefix,"");
$db_datos[] = $core->get_alias_campo("proyecto_metas",$db_prefix,"");
$db_datos[] = $core->get_alias_campo("proyecto_referencias",$db_prefix,"");
$db_datos[] = $core->get_alias_campo("proyecto_adjuntos",$db_prefix,"");
$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"",$dbname,"",""));
unset($db_datos);
unset($db_prefix);

//Mapas
$db_datos[] = $core->get_alias_campo("mapa_departamentos",$db_prefix,"");
$db_datos[] = $core->get_alias_campo("mapa_municipios",$db_prefix,"");
$db_datos[] = $core->get_alias_campo("mapa_macroregiones",$db_prefix,"");
$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"",$dbname,"",""));
unset($db_datos);
unset($db_prefix);

//Catalogos
$db_datos = array();
$db_datos[] = $core->get_alias_campo("proyecto_financiadores","","");
$db_datos[] = $core->get_alias_campo("proyecto_estados","","");
$db_datos[] = $core->get_alias_campo("proyecto_metas","","");
$db_datos[] = $core->get_alias_campo("proyecto_estados","","");
$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"c",$dbname,"",""));
unset($db_datos);
unset($db_prefix);

/**
 * Otras base de datos
 */
/*$dbname = "vrhr_territorio"; // otra base de datos que no es la principal
$db_datos = array();
$db_datos[] = $core->get_alias_campo("departamento","","");
$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"o",$dbname));
unset($db_datos);
unset($dbname);
unset($db_prefix);*/

$dbname = "vrhr_snir"; // otra base de datos que no es la principal
$db_prefix= "core_";
$db_datos[] = $core->get_alias_campo($db_prefix."usuario",$db_prefix,"");
$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"o",$dbname));
unset($db_datos);
unset($dbname);
unset($db_prefix);

/*
print_struc($CFGm->tabla);
print_struc($CFG->tabla);
exit;
*/