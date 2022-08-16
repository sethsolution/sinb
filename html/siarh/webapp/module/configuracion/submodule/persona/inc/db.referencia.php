<?php
/**
 * Configuración de referencias de las tablas de las base de datos que utilizaremos en este módulo
 *
 */
$CFGm->tabla = array();
/**
 * Tablas de información principal, configuración de los objetos principales
 */

$db_prefix = "persona_"; //prefijo de la base de datos
$db_datos = array();
$db_datos[] = $core->get_alias_campo("persona","","");
$db_datos[] = $core->get_alias_campo("oep_persona","","");
$db_datos[] = $core->get_alias_campo("persona_codice","","");
$db_datos[] = $core->get_alias_campo("persona_referencia","","");
$db_datos[] = $core->get_alias_campo("persona_archivo","","");
$db_datos[] = $core->get_alias_campo("persona_formacion_academica","","");
$db_datos[] = $core->get_alias_campo("persona_experiencia_laboral","","");
$db_datos[] = $core->get_alias_campo("persona_familia","","");

$db_datos[] = $core->get_alias_campo("persona_seguro","","");
$db_datos[] = $core->get_alias_campo("persona_cas","","");
$db_datos[] = $core->get_alias_campo("persona_asignaciones","","");

$db_datos[] = $core->get_alias_campo("persona_subsidio","","");

$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"",$dbname,"",""));
unset($db_datos);
unset($db_prefix);

$db_datos = array();
$db_datos[] = $core->get_alias_campo("afp","","");
$db_datos[] = $core->get_alias_campo("categoria","","");
$db_datos[] = $core->get_alias_campo("estado_civil","","");
$db_datos[] = $core->get_alias_campo("genero","","");
$db_datos[] = $core->get_alias_campo("modalidad","","");
$db_datos[] = $core->get_alias_campo("estado_civil","","");
$db_datos[] = $core->get_alias_campo("grupo_sanguineo","","");
$db_datos[] = $core->get_alias_campo("afp","","");
$db_datos[] = $core->get_alias_campo("institucion_financiera","","");
$db_datos[] = $core->get_alias_campo("formacion_grados","","");
$db_datos[] = $core->get_alias_campo("experiencia_respaldo","","");
$db_datos[] = $core->get_alias_campo("familia_tipo","","");

$db_datos[] = $core->get_alias_campo("seguro_entidad","","");

$db_datos[] = $core->get_alias_campo("subsidio_tipo","","");

$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"c",$dbname,"",""));
unset($db_datos);
unset($db_prefix);

/**
 * Otras base de datos
 */

$dbname = "vrhr_territorio"; // otra base de datos que no es la principal
$db_datos = array();
$db_datos[] = $core->get_alias_campo("departamento","","");
$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"o",$dbname));
unset($db_datos);
unset($dbname);
unset($db_prefix);



$dbname = $CFG->dbDatabase; // otra base de datos que no es la principal
$db_datos = array();
$db_datos[] = $core->get_alias_campo("core_usuario","core_","");
$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"o",$dbname));
unset($db_datos);
unset($dbname);
unset($db_prefix);



$dbname = "mmaya_entidad"; // otra base de datos que no es la principal
$db_datos = array();
$db_datos[] = $core->get_alias_campo("area","","");
$db_datos[] = $core->get_alias_campo("direccion","","");
$db_datos[] = $core->get_alias_campo("entidad","","");
$db_datos[] = $core->get_alias_campo("lugar","","");
$db_datos[] = $core->get_alias_campo("unidad","","");
$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"o",$dbname));
unset($db_datos);
unset($dbname);
unset($db_prefix);

$dbname = "codice_codice"; // otra base de datos que no es la principal
$db_datos = array();
$db_datos[] = $core->get_alias_campo("seguimiento","","");
$db_datos[] = $core->get_alias_campo("tipos","","");
$db_datos[] = $core->get_alias_campo("users","","");
$db_datos[] = $core->get_alias_campo("oficinas","","");
$db_datos[] = $core->get_alias_campo("entidades","","");
$db_datos[] = $core->get_alias_campo("documentos","","");
$db_datos[] = $core->get_alias_campo("estados","","");
$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"co",$dbname));
unset($db_datos);
unset($dbname);
unset($db_prefix);


$dbname = "personal_mmaya"; // otra base de datos que no es la principal
$db_datos = array();
$db_datos[] = $core->get_alias_campo("cla_feriados","","feriados");
$db_datos[] = $core->get_alias_campo("dat_rep_individual","","individual");


$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"per",$dbname));
unset($db_datos);
unset($dbname);
unset($db_prefix);


$dbname = "mmaya_rrhh_item"; // otra base de datos que no es la principal
$db_datos = array();
$db_datos[] = $core->get_alias_campo("item","","");
//$db_datos[] = $core->get_alias_campo("dat_rep_individual","","individual");


$CFGm->tabla = array_merge($CFGm->tabla,$core->get_tablas_from_array($db_datos,"puesto",$dbname));
unset($db_datos);
unset($dbname);
unset($db_prefix);


/* /
print_struc($CFGm->tabla);
exit;
/**/
//$core->writeLog($CFGm->tabla,__FILE__,__LINE__);
