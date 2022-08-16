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

$campos_item["detalle"]=array(
    "tipo"=>"text"
,   "label"=>"detalle");

$campos_item["numero_envase"]=array(
    "tipo"=>"text"
,   "label"=>"numero_envase");

$campos_item["numero_cortes"]=array(
    "tipo"=>"text"
,   "label"=>"numero_cortes");

$campos_item["peso_bruto"]=array(
    "tipo"=>"text"
,   "label"=>"peso_bruto");

$campos_item["peso_neto"]=array(
    "tipo"=>"text"
,   "label"=>"peso_neto");

$campos_item["equivalente_metros"]=array(
    "tipo"=>"text"
,   "label"=>"equivalente_metros");

$campos_item["codigo_precintos_utilizados"]=array(
    "tipo"=>"text"
,   "label"=>"codigo_precintos_utilizados");


$grupo = "precinto";
$campos[$grupo]= $campos_item;
unset($campos_item);

$campos_item = array();
$campos_item["codigo_conteo"]=array(
    "tipo"=>"text"
,   "label"=>"codigo_conteo");

$grupo = "general";

$campos[$grupo]= $campos_item;
unset($campos_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */
