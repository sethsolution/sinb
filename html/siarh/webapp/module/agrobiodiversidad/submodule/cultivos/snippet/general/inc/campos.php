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

$campos_item["espe_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"espe_itemid");

$campos_item["ecotipo_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"ecotipo_itemid");

$campos_item["especie_asocia_cultivo"]=array(
    "tipo"=>"text"
,   "label"=>"especie_asocia_cultivo");

$campos_item["vincula_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"vincula_itemid");

$campos_item["clasevincula_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"clasevincula_itemid");

$campos_item["espemain_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"espemain_itemid");

$campos_item["cantidad"]=array(
    "tipo"=>"text"
,   "label"=>"cantidad");

$campos_item["unidad_medida"]=array(
    "tipo"=>"text"
,   "label"=>"unidad_medida");

$campos_item["espe_adicional"]=array(
    "tipo"=>"text"
,   "label"=>"espe_adicional");

$campos_item["superficie"]=array(
    "tipo"=>"text"
,   "label"=>"superficie");

$campos_item["superficie_amplia"]=array(
    "tipo"=>"text"
,   "label"=>"superficie_amplia");

$campos_item["cod_certifica"]=array(
    "tipo"=>"text"
,   "label"=>"cod_certifica");

$campos_item["densidad"]=array(
    "tipo"=>"text"
,   "label"=>"densidad");

$campos_item["unidad_medida_densidad"]=array(
    "tipo"=>"text"
,   "label"=>"unidad_medida_densidad");

$campos_item["cant_recolectada"]=array(
    "tipo"=>"text"
,   "label"=>"cant_recolectada");

$campos_item["destino_conserva"]=array(
    "tipo"=>"text"
,   "label"=>"destino_conserva");

$campos_item["destino_autoconsumo"]=array(
    "tipo"=>"text"
,   "label"=>"destino_autoconsumo");

$campos_item["destino_comercia"]=array(
    "tipo"=>"text"
,   "label"=>"destino_comercia");

$campos_item["precio_comercia"]=array(
    "tipo"=>"text"
,   "label"=>"precio_comercia");

$campos_item["cant_familias"]=array(
    "tipo"=>"text"
,   "label"=>"cant_familias");

$campos_item["cant_materia_prima"]=array(
    "tipo"=>"text"
,   "label"=>"cant_materia_prima");

$campos_item["producto"]=array(
    "tipo"=>"text"
,   "label"=>"producto");

$campos_item["cant_producto"]=array(
    "tipo"=>"text"
,   "label"=>"cant_producto");

$campos_item["precio_produccion"]=array(
    "tipo"=>"text"
,   "label"=>"precio_produccion");

$campos_item["precio_venta"]=array(
    "tipo"=>"text"
,   "label"=>"precio_venta");

$campos_item["operarios"]=array(
    "tipo"=>"text"
,   "label"=>"operarios");

$campos_item["longitud"]=array(
    "tipo"=>"text"
,   "label"=>"longitud");

$campos_item["latitud"]=array(
    "tipo"=>"text"
,   "label"=>"latitud");

$campos_item["utm_este"]=array(
    "tipo"=>"text"
,   "label"=>"utm_este");

$campos_item["utm_norte"]=array(
    "tipo"=>"text"
,   "label"=>"utm_norte");

$campos_item["utm_zona"]=array(
    "tipo"=>"text"
,   "label"=>"utm_zona");

$campos_item["altitud"]=array(
    "tipo"=>"text"
,   "label"=>"altitud");

$campos_item["macroreg_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"macroreg_itemid");

$campos_item["depto_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"depto_itemid");

$campos_item["municipio_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"municipio_itemid");

$campos_item["comunidad"]=array(
    "tipo"=>"text"
,   "label"=>"comunidad");

$campos_item["zona"]=array(
    "tipo"=>"text"
,   "label"=>"zona");

/* $campos_item["fecha"]=array(
    "tipo"=>"text"
,   "label"=>"fecha"); */

$grupo = "campos_cultivos";
$campos[$grupo]= $campos_item;
unset($campos_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */

// Campos tabla alimento_municipios
/*$campos_item = array();

$campos_item["municipio_itemid"]=array(
    "tipo"=>"text"
,   "label"=>"municipio_itemid");

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