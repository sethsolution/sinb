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



$campos_item["curtiembre"]=array(
    "tipo"=>"text"
,   "label"=>"Nombre");

$campos_item["codigo"]=array(
    "tipo"=>"text"
,   "label"=>"Codigo");
$campos_item["tipo_empresa_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"Tipo");
$campos_item["fecha_exp"]=array(
    "tipo"=>"date_01"
,   "label"=>"Fecha");



$grupo = "curtiembre";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
