<?php
$msg_core = array();
$msg_core["soporte_numero"]= "(2) 211517, (2) 2115573 <strong>Internos:</strong> 1517 , 1205 ";
$msg_core["soporte_email"] = "sistemas@mmaya.gob.bo";
$msg_core["soporte_whatsapp"] = "http://web.whatsapp.com";
$smarty->assign("msg_core",$msg_core);

/**
 * Configuración para el boton de ayuda
 */
$manual_ayuda = array();





$manual_ayuda["general"] = 1;

$manual_ayuda["soporte"] = 1;
$manual_ayuda["pdf"] = 0;
$manual_ayuda["online"] = 0;
$manual_ayuda["online_url"] = "https://www.google.com/";
$manual_ayuda["ticket"] = 1;
$manual_ayuda["ticket_nombre"] = "Solicitud de Soporte";
$manual_ayuda["ticket_url"] = "https://gitlab.com/sirh/sys/issues/new";

$manual_ayuda["otro"] = 1;
$manual_ayuda["otro_titulo"] = "Comunidad SIARH";
$manual_ayuda["web"] = 1;
$manual_ayuda["web_nombre"] = "SIARH Web";
$manual_ayuda["web_url"] = "http://siarh.gob.bo/";
$manual_ayuda["fb"] = 1;
$manual_ayuda["fb_nombre"] = "Facebook";
$manual_ayuda["fb_url"] = "https://www.facebook.com/siarh.bolivia/";

