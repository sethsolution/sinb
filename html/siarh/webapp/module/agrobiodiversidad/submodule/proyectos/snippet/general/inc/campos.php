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

$campos_item["codigo"]=array(
    "tipo"=>"text"
,   "label"=>"codigo");

$campos_item["sigla"]=array(
    "tipo"=>"text"
,   "label"=>"sigla");

$campos_item["nombre"]=array(
    "tipo"=>"text"
,   "label"=>"nombre");

$campos_item["implementador"]=array(
    "tipo"=>"text"
,   "label"=>"implementador");

$campos_item["fecha_inicio"]=array(
    "tipo"=>"text"
,   "label"=>"fecha_inicio");

$campos_item["fecha_final"]=array(
    "tipo"=>"text"
,   "label"=>"fecha_final");

$campos_item["objetivo_principal"]=array(
    "tipo"=>"text"
,   "label"=>"objetivo_principal");

$campos_item["descrip"]=array(
    "tipo"=>"text"
,   "label"=>"descrip");

$campos_item["estado_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"estado_itemid");

$grupo = "campos_proyectos";
$campos[$grupo]= $campos_item;
unset($campos_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */

// Campos tabla proyecto_deptos
$campos_item = array();

$campos_item["proy_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"proy_itemid");

$campos_item["depto_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"depto_itemid");

$grupo = "campos_proyecto_deptos";
$campos[$grupo]= $campos_item;
unset($campos_item);

// Campos tabla proyecto_municipios
$campos_item = array();

$campos_item["proy_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"proy_itemid");

$campos_item["municipio_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"municipio_itemid");

$grupo = "campos_proyecto_municipios";
$campos[$grupo]= $campos_item;
unset($campos_item);