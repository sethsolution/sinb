<?php
//servicios reportes APi REST 
$CFG->servicio_reporte["activo"] = true;
$CFG->servicio_reporte["token"] = "";
$CFG->servicio_reporte["url"] = "http://190.104.31.2:3000/";
$CFG->servicio_reporte["parse_mode"] ='HTML';

//servicios reportes BIRT

//Para utilizar el servidor de Reportes en Produccion
$CFG->servicio_reporte["url_reporte"] ='http://192.168.5.59:8080/birt-viewer/frameset?__report=';

//Para utilizar el servidor de Reportes en Desarrollo (Pruebas)
//$CFG->servicio_reporte["url_reporte"] ='http://192.168.5.57:8080/birt-viewer/frameset?__report=';
