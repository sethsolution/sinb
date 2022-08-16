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

$grupo = "archivo";

$campos[$grupo]= $campos_item;
unset($campos_item);




$campos_item = array();


$campos_item["factura_monto"]=array(
    "tipo"=>"text"
,   "label"=>"factura_monto");
$campos_item["factura_pais_id"]=array(
    "tipo"=>"text"
,   "label"=>"factura_pais_id");
$campos_item["factura_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"factura_nombre");





$campos_item["zoosanitario_origen_numero"]=array(
    "tipo"=>"text"
,   "label"=>"zoosanitario_origen_numero");
$campos_item["zoosanitario_origen_emision"]=array(
    "tipo"=>"date_01"
,   "label"=>"zoosanitario_origen_emision");



$campos_item["zoosanitario_destino_numero"]=array(
    "tipo"=>"text"
,   "label"=>"zoosanitario_destino_numero");
$campos_item["zoosanitario_destino_emision"]=array(
    "tipo"=>"date_01"
,   "label"=>"zoosanitario_destino_emision");

$campos_item["nombre_proyecto"]=array(
    "tipo"=>"text"
,   "label"=>"nombre_proyecto");


$grupo = "general";

$campos[$grupo]= $campos_item;
unset($campos_item);






/**
 * Apartir de aca, puedes configurar otros campos
 */
