<?php
/**
 * Configuramos todas los grupos de campos, para creación y verificación de formulaios
 */
/**
 * Arreglos que se utilizaran en esta configuración para guardar los grupos de campos
 */
$campos = array();

/***
 * Configuraciòn de los grupos de campos a utilizar
 */
$campos_item = array();

$campos_item["institucion"]=array(
    "tipo"=>"text"
,   "label"=>"institucion");

$campos_item["sigla"]=array(
    "tipo"=>"text"
,   "label"=>"sigla");

$campos_item["sitio_web"]=array(
    "tipo"=>"text"
,   "label"=>"sitio_web");

$grupo = "campos_enlaces_institucionales";
$campos[$grupo]= $campos_item;
unset($campos_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */

// Campos tabla proyectos_municipios
/*$campos_item = array();

$campos_item["proy_id"]=array(
    "tipo"=>"text"
,   "label"=>"proy_id");

$campos_item["municipio_id"]=array(
    "tipo"=>"text"
,   "label"=>"municipio_id");

$grupo = "campos_proyectos_municipios";
$campos[$grupo]= $campos_item;
unset($campos_item);*/
