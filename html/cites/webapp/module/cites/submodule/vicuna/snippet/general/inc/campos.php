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


$campos_item["empresa_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"text");

$campos_item["representante_legal_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_nombre");

$campos_item["venta_monto"]=array(
    "tipo"=>"text"
,   "label"=>"venta_monto");

$campos_item["venta_cantidad"]=array(
    "tipo"=>"text"
,   "label"=>"venta_cantidad");

$campos_item["unidad_id"]=array(
    "tipo"=>"text"
,   "label"=>"unidad_id");

$grupo = "general";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
