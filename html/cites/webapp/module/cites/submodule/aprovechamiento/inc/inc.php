<?php
/**
 * User: henrytaby
 * Date: 10/06/2020
 * Time: 21:57
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
$CFGm->carpeta_padre = "cites";
$CFGm->directory = $CFG->data.$CFGm->carpeta_padre."/";
$core->directorio_crear($CFGm->directory);
/**
 *  Verificamos y/o Creamos la carpeta del módulo
 */
$CFGm->carpeta_modulo = "cites";
$CFGm->directory = $CFGm->directory.$CFGm->carpeta_modulo."/";
$core->directorio_crear($CFGm->directory);
//$dbm->debug = true;

//$smarty->debugging = true;

/**
 * Configuración para el boton de ayuda
 */

$manual_ayuda["general"] = 1;

$manual_ayuda["soporte"] = 1;
$manual_ayuda["pdf"] = 1;
$manual_ayuda["online"] = 0;
$manual_ayuda["online_url"] = "https://www.google.com/";
$manual_ayuda["ticket"] = 1;
//$manual_ayuda["ticket_nombre"] = "Solicitud de Soporte";
//$manual_ayuda["ticket_url"] = "https://gitlab.com/sirh/sys/issues/new";

$manual_ayuda["otro"] = 1;
$manual_ayuda["otro_titulo"] = "MMAyA";
$manual_ayuda["web"] = 1;
$manual_ayuda["web_nombre"] = "MMAyA Web";
$manual_ayuda["web_url"] = "https://mmaya.gob.bo/";
$manual_ayuda["fb"] = 0;
//$manual_ayuda["fb_nombre"] = "Facebook";
//$manual_ayuda["fb_url"] = "https://www.facebook.com/siarh.bolivia/";

$smarty->assign("manual_ayuda",$manual_ayuda);
