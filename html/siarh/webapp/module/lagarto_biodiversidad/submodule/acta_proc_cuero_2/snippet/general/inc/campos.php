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


$campos_item["total_precio"]=array(
    "tipo"=>"text"
,   "label"=>"Total Precio");

$campos_item["precio_colas"]=array(
    "tipo"=>"text"
,   "label"=>"Precio Colas");
$campos_item["fecha_acta"]=array(
    "tipo"=>"text"
,   "label"=>"Fecha Acta");
$campos_item["total_pie_cuadrado"]=array(
    "tipo"=>"text"
,   "label"=>"Total Pie Cuadrado");
$campos_item["estado"]=array(
    "tipo"=>"checkbox_01"
,   "label"=>"Estado");

$grupo = "acta_cuero";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
