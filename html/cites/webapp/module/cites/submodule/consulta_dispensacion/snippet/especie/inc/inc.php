<?php
/**
 * Configuración del módulo especifico
 */
/*
// Ejemplo
$variable_ejemplo = $path_sbm."snippet/".$subcontrol."/inc/archivo_ejemplo.php";
if(is_file($variable_ejemplo)) include_once($variable_ejemplo);
*/

$CFGm->carpeta_padre = "dispensacion";
$CFGm->directory = $CFG->data.$CFGm->carpeta_padre."/";
$core->directorio_crear($CFGm->directory);
/**
 * Verificamos y/o Creamos la carpeta del módulo
 */
$CFGm->carpeta_modulo = "empresa";
$CFGm->directory = $CFGm->directory.$CFGm->carpeta_modulo."/";
$core->directorio_crear($CFGm->directory);