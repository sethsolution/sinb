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
$db_datos[] = $core->get_alias_campo("catalogos",$db_prefix,"");

$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"",$dbname,"",""));
unset($db_datos);
unset($db_prefix);

//Catalogos
$db_datos = array();
$db_datos[] = $core->get_alias_campo("categorias","","");
$db_datos[] = $core->get_alias_campo("compuestos","","");
$db_datos[] = $core->get_alias_campo("destinos","","");
$db_datos[] = $core->get_alias_campo("ejes_tematicos","","");
$db_datos[] = $core->get_alias_campo("grupos_analisis","","");
$db_datos[] = $core->get_alias_campo("perfil_acidos_grasos","","");
$db_datos[] = $core->get_alias_campo("tipo_documentos","","");
$db_datos[] = $core->get_alias_campo("taxonomia_division","","");
$db_datos[] = $core->get_alias_campo("taxonomia_clase","","");
$db_datos[] = $core->get_alias_campo("taxonomia_orden","","");
$db_datos[] = $core->get_alias_campo("taxonomia_familia","","");
$db_datos[] = $core->get_alias_campo("taxonomia_genero","","");
$db_datos[] = $core->get_alias_campo("taxonomia_especie","","");
$db_datos[] = $core->get_alias_campo("plan_manejo","","");
$db_datos[] = $core->get_alias_campo("certificacion_ecologica","","");
$db_datos[] = $core->get_alias_campo("proyecto_financiadores","","");
$db_datos[] = $core->get_alias_campo("territorios","","");
$db_datos[] = $core->get_alias_campo("metodos_conservacion","","");
$db_datos[] = $core->get_alias_campo("estrategias_conservacion","","");
$db_datos[] = $core->get_alias_campo("categorias_uso","","");
$db_datos[] = $core->get_alias_campo("status_conservacion","","");
$db_datos[] = $core->get_alias_campo("proyecto_metas","","");
$db_datos[] = $core->get_alias_campo("vinculaciones","","");
$db_datos[] = $core->get_alias_campo("clases_vinculacion","","");
$db_datos[] = $core->get_alias_campo("tipos_valor_compuesto","","");
$db_datos[] = $core->get_alias_campo("estados_operacion","","");
$db_datos[] = $core->get_alias_campo("mapa_macroregiones","","");
$db_datos[] = $core->get_alias_campo("proyecto_categoria_metas","","");
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