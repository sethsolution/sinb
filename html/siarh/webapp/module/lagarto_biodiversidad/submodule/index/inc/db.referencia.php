<?php
/**
 * Configuración de referncias de las tablas de las base de datos que utilizaremos en este módulo
 *
 */
$CFGm->tabla = array();
/**
 * Tablas de información principal, configuración de los objetos principales
 */
$tname = "item_"; //sufijo que puedes o no usar
$db_datos = array();
//$db_datos[] = $tname;
//$db_datos[] = $tname."_otros";
//$db_datos[] = $tname."_colores";
$db_datos[] = "persona";
$db_datos[] = "item";

$CFGm->tabla = array_merge($CFGm->tabla,$core->db_tableConvert($db_datos));
unset($db_datos);

/**
 * Tablas de catalogos, dentro la base de datos principal
 */
$db_datos = array();
$db_datos[] = "afp";
$db_datos[] = "categoria";
$db_datos[] = "estado_civil";
$db_datos[] = "genero";
$db_datos[] = "modalidad";
$CFGm->tabla = array_merge($CFGm->tabla,$core->db_tableConvert($db_datos,"c"));
unset($db_datos);
/**
 * Otra base de datos
 */
/**
 * Tablas de información de catalogo territorio
 */
$dbname = "vrhr_territorio"; // otra base de datos que no es la principal
$db_datos = array();
$db_datos[] = "departamento";
//$db_datos[] = "provincia";
//$db_datos[] = "municipio";
//$db_datos[] = "comunidad";
//$db_datos[] = "localidad";
$CFGm->tabla = array_merge($CFGm->tabla,$core->db_tableConvert($db_datos,"o",$dbname));
unset($db_datos);
/**
 * Tablas de información de catalogo territorio
 */
$dbname = "vrhr_snir"; // otra base de datos que no es la principal
$db_datos = array();
$db_datos[] = "core_usuario";
$CFGm->tabla = array_merge($CFGm->tabla,$core->db_tableConvert($db_datos,"o",$dbname));
unset($db_datos);
/**
 * Tablas de información de Entidad
 */
$dbname = "mmaya_entidad"; // otra base de datos que no es la principal
$db_datos = array();
$db_datos[] = "area";
$db_datos[] = "direccion";
$db_datos[] = "entidad";
$db_datos[] = "lugar";
$db_datos[] = "unidad";
$CFGm->tabla = array_merge($CFGm->tabla,$core->db_tableConvert($db_datos,"o",$dbname));
unset($db_datos);
