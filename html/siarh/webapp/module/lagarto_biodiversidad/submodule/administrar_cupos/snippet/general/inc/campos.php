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



$campos_item["gestion_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"Gestion");
$campos_item["tco_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"TCO");
$campos_item["cupo_total"]=array(
    "tipo"=>"number"
,   "label"=>"Cupo Total");
$campos_item["cupo_parcial"]=array(
    "tipo"=>"number"
,   "label"=>"Cupo Parcial");

$grupo = "gestion_tco";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
