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


$campos_item["nombre"]=array(
    "tipo"=>"text"
,   "label"=>"nombre");

$campos_item["representante_legal_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_nombre");

$campos_item["cantidad"]=array(
    "tipo"=>"text"
,   "label"=>"cantidad");

$campos_item["gestion"]=array(
    "tipo"=>"text"
,   "label"=>"gestion");

$campos_item["precinto_tipo"]=array(
    "tipo"=>"text"
,   "label"=>"precinto_tipo");


$grupo = "general";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
