<?php
/**
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 10:47
 */
//$modulo_core->privface_extender();
/**
 * Incluimos otros archivos adicionales si fuera necesario
 */
/*
$inc_otro_archivo = $path_sbm_inc."otro_archivo.php";
include_once($inc_otro_archivo);
*/
/**
 * Configuración del servidor pentaho de reportes
 */
//$CFGm->pentaho["url"] = "http://192.168.5.180:8080/pentaho/api/repos/";
$CFGm->pentaho["url"] = $CFG->pentaho["url"];
$CFGm->pentaho["carpeta"] = ":siarh:rrhh:item:";
$CFGm->pentaho["user"] = $CFG->pentaho["user"];
$CFGm->pentaho["password"] = $CFG->pentaho["password"];

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
$CFGm->carpeta_padre = "configuracion";
$CFGm->directory = $CFG->data.$CFGm->carpeta_padre."/";
$core->directorio_crear($CFGm->directory);
/**
 *  Verificamos y/o Creamos la carpeta del módulo
 */
$CFGm->carpeta_modulo = "mascara";
$CFGm->directory = $CFGm->directory.$CFGm->carpeta_modulo."/";
$core->directorio_crear($CFGm->directory);
//$dbm->debug = true;