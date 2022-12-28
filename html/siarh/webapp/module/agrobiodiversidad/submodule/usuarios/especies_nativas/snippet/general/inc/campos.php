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

$campos_item["nombre_vernacular"]=array(
    "tipo"=>"text"
,   "label"=>"nombre_vernacular");

$campos_item["carac_botanicas"]=array(
    "tipo"=>"text"
,   "label"=>"carac_botanicas");

$campos_item["com_cultiva_aprovecha"]=array(
    "tipo"=>"text"
,   "label"=>"com_cultiva_aprovecha");

$campos_item["catuso_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"catuso_itemid");

$campos_item["tiempo_uso"]=array(
    "tipo"=>"text"
,   "label"=>"tiempo_uso");

$campos_item["rel_etnobotanica"]=array(
    "tipo"=>"text"
,   "label"=>"rel_etnobotanica");

$campos_item["carac_bioculturales"]=array(
    "tipo"=>"text"
,   "label"=>"carac_bioculturales");

$campos_item["statusconserva_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"statusconserva_itemid");

$campos_item["codigo_registro"]=array(
    "tipo"=>"text"
,   "label"=>"codigo_registro");

$grupo = "campos_especies_nativas";
$campos[$grupo]= $campos_item;
unset($campos_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */
// Campos tabla especie_nativa_macroregiones
$campos_item = array();

$campos_item["espenativa_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"espenativa_itemid");

$campos_item["macroreg_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"macroreg_itemid");

$grupo = "campos_especie_nativa_macroregiones";
$campos[$grupo]= $campos_item;
unset($campos_item);

// Campos tabla especie_nativa_deptos
$campos_item = array();

$campos_item["espenativa_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"espenativa_itemid");

$campos_item["depto_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"depto_itemid");

$grupo = "campos_especie_nativa_deptos";
$campos[$grupo]= $campos_item;
unset($campos_item);

// Campos tabla especie_municipios
$campos_item = array();

$campos_item["espenativa_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"espenativa_itemid");

$campos_item["municipio_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"municipio_itemid");

$grupo = "campos_especie_nativa_municipios";
$campos[$grupo]= $campos_item;
unset($campos_item);
