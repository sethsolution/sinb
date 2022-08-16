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



$campos_item["especie_id"]=array(
    "tipo"=>"text"
,   "label"=>"especie_id");
$campos_item["especie_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"especie_nombre");
$campos_item["descripcion"]=array(
    "tipo"=>"text"
,   "label"=>"descripcion");


$campos_item["cantidad"]=array(
    "tipo"=>"text"
,   "label"=>"cantidad");
$campos_item["unidad_id"]=array(
    "tipo"=>"text"
,   "label"=>"unidad_id");

$campos_item["cantidad_aprobada"]=array(
    "tipo"=>"text"
,   "label"=>"cantidad_aprobada");


$grupo = "especie";
$campos[$grupo]= $campos_item;
unset($campos_item);


/**
 * Apartir de aca, puedes configurar otros campos
 */
