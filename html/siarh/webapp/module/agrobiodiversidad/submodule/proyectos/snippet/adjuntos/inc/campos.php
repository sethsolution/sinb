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

$campos_item["proy_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"proy_itemid");

$campos_item["descrip"]=array(
    "tipo"=>"text"
,   "label"=>"descrip");

$grupo = "campos_proyecto_adjuntos";
$campos[$grupo]= $campos_item;
unset($campos_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */

// Campos tabla proyectos_otros
/*$campos_item["itemid"]=array(
    "tipo"=>"text"
,   "label"=>"itemid");

$campos_item["sisin"]=array(
    "tipo"=>"text"
,   "label"=>"sisin");

$campos_item["ha_forestada"]=array(
    "tipo"=>"text"
,   "label"=>"ha_forestada");

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