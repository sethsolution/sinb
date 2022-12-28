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

$campos_item["nombre_comun"]=array(
    "tipo"=>"text"
,   "label"=>"nombre_comun");

$campos_item["nombre_cientifico"]=array(
    "tipo"=>"text"
,   "label"=>"nombre_cientifico");

$campos_item["cat_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"cat_itemid");

$campos_item["macroreg_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"macroreg_itemid");

$campos_item["descrip"]=array(
    "tipo"=>"text"
,   "label"=>"descrip");

$campos_item["taxdiv_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"taxdiv_itemid");

$campos_item["taxclase_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"taxclase_itemid");

$campos_item["taxorden_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"taxorden_itemid");

$campos_item["taxfam_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"taxfam_itemid");

$campos_item["taxgen_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"taxgen_itemid");

$campos_item["taxespe_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"taxespe_itemid");

$campos_item["subespecie"]=array(
    "tipo"=>"text"
,   "label"=>"subespecie");

$grupo = "campos_especies";
$campos[$grupo]= $campos_item;
unset($campos_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */

// Campos tabla especie_municipios
$campos_item = array();

$campos_item["espe_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"espe_itemid");

$campos_item["municipio_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"municipio_itemid");

$grupo = "campos_especie_municipios";
$campos[$grupo]= $campos_item;
unset($campos_item);


// Campos tabla especie_adjuntos
/*$campos_item = array();

$campos_item["espe_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"espe_itemid");

$campos_item["adjunto_ancho"]=array(
    "tipo"=>"text"
,   "label"=>"adjunto_ancho");

$campos_item["adjunto_alto"]=array(
    "tipo"=>"text"
,   "label"=>"adjunto_alto");

$grupo = "campos_especie_adjuntos";
$campos[$grupo]= $campos_item;
unset($campos_item);*/
