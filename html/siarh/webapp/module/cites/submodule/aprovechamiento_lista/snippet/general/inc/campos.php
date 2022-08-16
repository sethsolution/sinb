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

$campos_item["tipo_id"]=array(
    "tipo"=>"text"
,   "label"=>"tipo_id");


$campos_item["numero_informe"]=array(
    "tipo"=>"text"
,   "label"=>"numero_informe");

$campos_item["fecha_reporte"]=array(
    "tipo"=>"date_01"
,   "label"=>"fecha_reporte");

$campos_item["emite_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"emite_nombre");

$campos_item["emite_cargo"]=array(
    "tipo"=>"text"
,   "label"=>"text");

$campos_item["emite_cargo"]=array(
    "tipo"=>"text"
,   "label"=>"emite_cargo");

$campos_item["para_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"para_nombre");

$campos_item["para_cargo"]=array(
    "tipo"=>"text"
,   "label"=>"para_cargo");

$campos_item["ciudad"]=array(
    "tipo"=>"text"
,   "label"=>"text");

$campos_item["referencia"]=array(
    "tipo"=>"text"
,   "label"=>"text");

$campos_item["texto_introductorio"]=array(
    "tipo"=>"text"
,   "label"=>"texto_introductorio");

$grupo = "general";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
