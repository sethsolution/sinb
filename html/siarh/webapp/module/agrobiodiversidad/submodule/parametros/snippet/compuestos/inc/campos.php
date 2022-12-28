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

$campos_item["nombre_corto"]=array(
    "tipo"=>"text"
,   "label"=>"nombre_corto");

$campos_item["medida"]=array(
    "tipo"=>"text"
,   "label"=>"medida");

$campos_item["activo"]=array(
    "tipo"=>"text"
,   "label"=>"activo");

$campos_item["grpanalisis_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"grpanalisis_itemid");

$campos_item["peracidg_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"peracidg_itemid");

$grupo = "campos_compuestos";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */