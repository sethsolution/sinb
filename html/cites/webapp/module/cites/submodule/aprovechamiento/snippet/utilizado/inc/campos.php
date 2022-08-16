<?
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

$campos_item["aprovechamiento_id"]=array(
    "tipo"=>"text"
,   "label"=>"aprovechamiento_id");

$campos_item["anio"]=array(
    "tipo"=>"text"
,   "label"=>"anio");

$campos_item["precinto_inicial"]=array(
    "tipo"=>"text"
,   "label"=>"precinto_inicial");

$campos_item["precinto_final"]=array(
    "tipo"=>"text"
,   "label"=>"precinto_final");

$campos_item["precinto_total_utilizados"]=array(
    "tipo"=>"text"
,   "label"=>"precinto_total_utilizados");

$campos_item["precinto_total_noutilizados"]=array(
    "tipo"=>"text"
,   "label"=>"precinto_total_noutilizados");

$campos_item["codigo_precintos_baja"]=array(
    "tipo"=>"text"
,   "label"=>"codigo_precintos_baja");

$campos_item["observaciones"]=array(
    "tipo"=>"text"
,   "label"=>"observaciones");


$grupo = "precinto";
$campos[$grupo]= $campos_item;
unset($campos_item);

$campos_item = array();
$campos_item["codigo_utilizado"]=array(
    "tipo"=>"text"
,   "label"=>"codigo_utilizado");

$grupo = "general";

$campos[$grupo]= $campos_item;
unset($campos_item);


/**
 * Apartir de aca, puedes configurar otros campos
 */
