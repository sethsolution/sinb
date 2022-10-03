<?php
/**
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 10:47
 */

/**
 * Incluimos otros archivos adicionales si fuera necesario
 */
/*
$inc_otro_archivo = $path_sbm_inc."otro_archivo.php";
include_once($inc_otro_archivo);
*/

/**
 * Configuramos el directorio para este modulo
 */
/**
 * En caso de colocar todo en una sola carpeta del modulo
 */
//$CFGm->directory = $CFG->data.$module."/";
/**
 * Verificamos y/o Creamos la carpeta padre
 */

/**
 * Verificamos y/o Creamos la carpeta padre
 */
$CFGm->carpeta_padre = "rrhh";
$CFGm->directory = $CFG->data.$CFGm->carpeta_padre."/";
$core->directorio_crear($CFGm->directory);
/**
 * Verificamos y/o Creamos la carpeta del módulo
 */
$CFGm->carpeta_modulo = "persona";
$CFGm->directory = $CFGm->directory.$CFGm->carpeta_modulo."/";
$core->directorio_crear($CFGm->directory);