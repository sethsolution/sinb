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
$campos_item["fecha"]=array(
    "tipo"=>"date_01"
,   "label"=>"fecha");

$campos_item["descripcion"]=array(
    "tipo"=>"text"
,   "label"=>"descripcion");

$campos_item["numero_inicio"]=array(
    "tipo"=>"text"
,   "label"=>"numero_inicio");

$campos_item["numero_fin"]=array(
    "tipo"=>"text"
,   "label"=>"numero_fin");

$grupo = "general";
$campos[$grupo]= $campos_item;
unset($campos_item);
