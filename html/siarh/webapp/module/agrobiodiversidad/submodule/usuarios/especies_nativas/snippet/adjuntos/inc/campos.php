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

$campos_item["espenativa_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"espenativa_itemid");

$campos_item["descrip"]=array(
    "tipo"=>"text"
,   "label"=>"descrip");

$grupo = "campos_especie_nativa_adjuntos";
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
