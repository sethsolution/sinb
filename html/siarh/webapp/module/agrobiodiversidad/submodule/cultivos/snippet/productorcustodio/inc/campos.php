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

$campos_item["itemId"]=array(
    "tipo"=>"text"
,   "label"=>"itemId");

$campos_item["prod_organizacion"]=array(
    "tipo"=>"text"
,   "label"=>"prod_organizacion");

$campos_item["prod_ci"]=array(
    "tipo"=>"text"
,   "label"=>"prod_ci");

$campos_item["prod_nombres_apellidos"]=array(
    "tipo"=>"text"
,   "label"=>"prod_nombres_apellidos");

$campos_item["prod_sexo"]=array(
    "tipo"=>"text"
,   "label"=>"prod_sexo");

$campos_item["prod_celular"]=array(
    "tipo"=>"text"
,   "label"=>"prod_celular");

$campos_item["correo_e"]=array(
    "tipo"=>"text"
,   "label"=>"correo_e");

/*
$campos_item["cus_ci"]=array(
    "tipo"=>"text"
,   "label"=>"cus_ci");

$campos_item["cus_nombres_apellidos"]=array(
    "tipo"=>"text"
,   "label"=>"cus_nombres_apellidos");

$campos_item["cus_sexo"]=array(
    "tipo"=>"text"
,   "label"=>"cus_sexo");

$campos_item["cus_celular"]=array(
    "tipo"=>"text"
,   "label"=>"cus_celular");
*/
$grupo = "campos_productores_custodios";
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