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

$campos_item["macroreg_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"macroreg_itemid");

$campos_item["territorio_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"territorio_itemid");

$campos_item["tipodoc_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"tipodoc_itemid");

$campos_item["titulo"]=array(
    "tipo"=>"text"
,   "label"=>"titulo");

$campos_item["ejetem_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"ejetem_itemid");

$campos_item["anio_publicacion"]=array(
    "tipo"=>"text"
,   "label"=>"anio_publicacion");

$campos_item["pais_origen"]=array(
    "tipo"=>"text"
,   "label"=>"pais_origen");

$campos_item["autor"]=array(
    "tipo"=>"text"
,   "label"=>"autor");

$campos_item["nombre_cientifico"]=array(
    "tipo"=>"text"
,   "label"=>"nombre_cientifico");

$campos_item["especies"]=array(
    "tipo"=>"text"
,   "label"=>"especies");

$campos_item["sigla_institucion"]=array(
    "tipo"=>"text"
,   "label"=>"sigla_institucion");

$grupo = "campos_documentos";
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
