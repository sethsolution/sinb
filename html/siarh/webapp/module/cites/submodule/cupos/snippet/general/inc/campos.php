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
,   "label"=>"descripcion");

$campos_item["gestion"]=array(
    "tipo"=>"text"
,   "label"=>"gestion");

$campos_item["itemId"]=array(
    "tipo"=>"text"
,   "label"=>"itemId");

$grupo = "general";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
