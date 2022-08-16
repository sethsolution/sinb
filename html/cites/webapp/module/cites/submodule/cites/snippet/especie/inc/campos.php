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
,   "label"=>"modescripcionnto");


$campos_item["apendice_id"]=array(
    "tipo"=>"text"
,   "label"=>"apendice_id");
$campos_item["origen_id"]=array(
    "tipo"=>"text"
,   "label"=>"origen_id");
$campos_item["origen_descripcion"]=array(
    "tipo"=>"text"
,   "label"=>"origen_descripcion");

$campos_item["cantidad"]=array(
    "tipo"=>"text"
,   "label"=>"cantidad");
$campos_item["unidad_id"]=array(
    "tipo"=>"text"
,   "label"=>"unidad_id");
$campos_item["unidad_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"unidad_nombre");

$campos_item["pais_id"]=array(
    "tipo"=>"text"
,   "label"=>"pais_id");
$campos_item["numero_permiso"]=array(
    "tipo"=>"text"
,   "label"=>"numero_permiso");

$campos_item["monto"]=array(
    "tipo"=>"text"
,   "label"=>"monto");

$campos_item["monto_usd"]=array(
    "tipo"=>"text"
,   "label"=>"monto_usd");


$campos_item["cantidad_pt"]=array(
    "tipo"=>"text"
,   "label"=>"cantidad_pt");

$campos_item["cantidad_pzs"]=array(
    "tipo"=>"text"
,   "label"=>"cantidad_pzs");


$grupo = "especie";
$campos[$grupo]= $campos_item;
unset($campos_item);


/**
 * Apartir de aca, puedes configurar otros campos
 */
