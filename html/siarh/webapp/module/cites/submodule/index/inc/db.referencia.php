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
$db_datos[] = "item";
$db_datos[] = "item_departamento";
$db_datos[] = "item_convenio";
$db_datos[] = "item_convenio_ejecutora";

$CFGm->tabla = array_merge($CFGm->tabla,$core->db_tableConvert($db_datos));
unset($db_datos);

/**
 * Tablas de catalogos, dentro la base de datos principal
 */
$db_datos = array();
$db_datos[] = "norma";
$db_datos[] = "estado";
$db_datos[] = "convenio_tipo_financiamiento";
$db_datos[] = "convenio_financiadora";
$db_datos[] = "convenio_moneda";
$db_datos[] = "convenio_ejecutora";
$db_datos[] = "convenio_implementadora";
$CFGm->tabla = array_merge($CFGm->tabla,$core->db_tableConvert($db_datos,"c"));
unset($db_datos);
/**
 * Otra base de datos
 */
