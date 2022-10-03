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


$campos_item["precio_carne_primera"]=array(
    "tipo"=>"text"
,   "label"=>"Fecha Acta");
$campos_item["fecha_acta"]=array(
    "tipo"=>"text"
,   "label"=>"Fecha Acta");
$campos_item["precio_carne_segunda"]=array(
    "tipo"=>"text"
,   "label"=>"Total Pie Cuadrado");
$campos_item["precio_charque"]=array(
    "tipo"=>"text"
,   "label"=>"Total Pie Cuadrado");
$campos_item["estado"]=array(
    "tipo"=>"checkbox_01"
,   "label"=>"Estado");

$grupo = "acta_carne";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
