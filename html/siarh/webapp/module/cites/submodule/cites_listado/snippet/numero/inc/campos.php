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
$campos_item["descripcion"]=array(
    "tipo"=>"text"
,   "label"=>"modescripcionnto");
$campos_item["numero_id"]=array(
    "tipo"=>"text"
,   "label"=>"numero_id");
$grupo = "numero";
$campos[$grupo]= $campos_item;
unset($campos_item);

$campos_item = array();
$campos_item["autoridad_administrativa"]=array(
    "tipo"=>"text"
,   "label"=>"autoridad_administrativa");

$campos_item["emitido_lugar"]=array(
    "tipo"=>"text"
,   "label"=>"emitido_lugar");

$campos_item["emitido_fecha"]=array(
    "tipo"=>"date_01"
,   "label"=>"emitido_fecha");

$campos_item["numero_estampilla"]=array(
    "tipo"=>"text"
,   "label"=>"numero_estampilla");

$campos_item["impreso"]=array(
    "tipo"=>"text"
,   "label"=>"impreso");



$grupo = "general";
$campos[$grupo]= $campos_item;
unset($campos_item);


/**
 * Apartir de aca, puedes configurar otros campos
 */
