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

$campos_item["user_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"user_itemid");

$campos_item["rol_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"rol_itemid");

$campos_item["crear"]=array(
    "tipo"=>"text"
,   "label"=>"crear");

$campos_item["editar"]=array(
    "tipo"=>"text"
,   "label"=>"editar");

$campos_item["eliminar"]=array(
    "tipo"=>"text"
,   "label"=>"eliminar");

$grupo = "campos_usuario_permisos";
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
