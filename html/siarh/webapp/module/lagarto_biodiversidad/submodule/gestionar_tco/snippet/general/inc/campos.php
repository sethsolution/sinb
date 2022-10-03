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



$campos_item["tco"]=array(
    "tipo"=>"text"
,   "label"=>"TCO");

$campos_item["municipio_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"Municipio");



$grupo = "catalogo_tco";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
