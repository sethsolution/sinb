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

$campos_item["meta_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"meta_itemid");

$campos_item["linea_base"]=array(
    "tipo"=>"text"
,   "label"=>"linea_base");

$campos_item["meta"]=array(
    "tipo"=>"text"
,   "label"=>"meta");

$grupo = "campos_proyecto_metas";
$campos[$grupo]= $campos_item;
unset($campos_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */

// Campos tabla alimento_municipios
/*$campos_item = array();

$campos_item["espe_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"espe_itemid");

$campos_item["municipio_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"municipio_itemid");

$grupo = "campos_especie_municipios";
$campos[$grupo]= $campos_item;
unset($campos_item);*/
