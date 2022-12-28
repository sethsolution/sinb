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

$campos_item["nombre"]=array(
    "tipo"=>"text"
,   "label"=>"nombre");

$campos_item["descrip"]=array(
    "tipo"=>"text"
,   "label"=>"descrip");

$campos_item["adjunto_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"adjunto_nombre");

$campos_item["adjunto_extension"]=array(
    "tipo"=>"text"
,   "label"=>"adjunto_extension");

$campos_item["adjunto_tamano"]=array(
    "tipo"=>"text"
,   "label"=>"adjunto_tamano");

$campos_item["adjunto_tipo"]=array(
    "tipo"=>"text"
,   "label"=>"adjunto_tipo");

$grupo = "campos_shapefiles";
$campos[$grupo]= $campos_item;
unset($campos_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */

// Campos tabla alimento_municipios
/*$campos_item = array();

$campos_item["municipio_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"municipio_itemid");

$grupo = "campos_proyectos_forestales";
$campos[$grupo]= $campos_item;
unset($campos_item);*/

// Campos tabla proyectos_municipios
/*$campos_item["proy_id"]=array(
    "tipo"=>"text"
,   "label"=>"proy_id");

$campos_item["municipio_id"]=array(
    "tipo"=>"text"
,   "label"=>"municipio_id");

$grupo = "campos_proyectos_municipios";
$campos[$grupo]= $campos_item;
unset($campos_item);*/