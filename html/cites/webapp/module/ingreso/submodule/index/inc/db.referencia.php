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
$db_datos[] = "demo";
$CFGm->tabla = array_merge($CFGm->tabla,$core->db_tableConvert($db_datos));
unset($db_datos);

/**
 * Tablas de catalogos, dentro la base de datos principal
 */
$db_datos = array();
$db_datos[] = "demo";
$CFGm->tabla = array_merge($CFGm->tabla,$core->db_tableConvert($db_datos,"c"));
unset($db_datos);
/**
 * Otra base de datos
 */
/**
 * Tablas de información de catalogo territorio
 */