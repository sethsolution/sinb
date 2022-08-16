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

$campos_item["proforma_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"proforma_nombre");
$campos_item["proforma_pais_id"]=array(
    "tipo"=>"text"
,   "label"=>"proforma_pais_id");
$campos_item["proforma_monto"]=array(
    "tipo"=>"text"
,   "label"=>"proforma_monto");


$campos_item["cefo_numero"]=array(
    "tipo"=>"text"
,   "label"=>"cefo_numero");
$campos_item["cefo_caducidad"]=array(
    "tipo"=>"date_01"
,   "label"=>"cefo_caducidad");
$campos_item["cefo_destinatario"]=array(
    "tipo"=>"text"
,   "label"=>"cefo_destinatario");
$campos_item["cefo_catidad"]=array(
    "tipo"=>"text"
,   "label"=>"cefo_catidad");


$campos_item["precinto_numero"]=array(
    "tipo"=>"text"
,   "label"=>"precinto_numero");
$campos_item["precinto_inicio"]=array(
    "tipo"=>"text"
,   "label"=>"precinto_inicio");
$campos_item["precinto_ultimo"]=array(
    "tipo"=>"text"
,   "label"=>"precinto_ultimo");




$campos_item["factura_monto"]=array(
    "tipo"=>"text"
,   "label"=>"factura_monto");
$campos_item["factura_pais_id"]=array(
    "tipo"=>"text"
,   "label"=>"factura_pais_id");
$campos_item["factura_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"factura_nombre");



$campos_item["cites_numero"]=array(
    "tipo"=>"text"
,   "label"=>"cites_numero");
$campos_item["cites_emision"]=array(
    "tipo"=>"date_01"
,    "label"=>"cites_emision");


$campos_item["zoosanitario_numero"]=array(
    "tipo"=>"text"
,   "label"=>"zoosanitario_numero");
$campos_item["zoosanitario_emision"]=array(
    "tipo"=>"date_01"
,   "label"=>"zoosanitario_emision");


$campos_item["destino_telefono"]=array(
    "tipo"=>"text"
,   "label"=>"destino_telefono");
$campos_item["destino_direccion"]=array(
    "tipo"=>"text"
,   "label"=>"destino_direccion");

$campos_item["nombre_proyecto"]=array(
    "tipo"=>"text"
,   "label"=>"nombre_proyecto");

$campos_item["estado_id"]=array(
    "tipo"=>"date_01"
,   "label"=>"estado_id");

$grupo = "general";

$campos[$grupo]= $campos_item;
unset($campos_item);






/**
 * Apartir de aca, puedes configurar otros campos
 */
