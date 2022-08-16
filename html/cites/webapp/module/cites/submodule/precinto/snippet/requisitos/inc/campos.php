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

$campos_item["cantidad"]=array(
    "tipo"=>"text"
,   "label"=>"cantidad");

$campos_item["gestion"]=array(
    "tipo"=>"text"
,   "label"=>"gestion");

$campos_item["representante_legal_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_nombre");

$campos_item["empresa_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"empresa_nombre");

$campos_item["tipo_aprovechamiento"]=array(
    "tipo"=>"text"
,   "label"=>"tipo_aprovechamiento");

$campos_item["estado_id"]=array(
    "tipo"=>"date_01"
,   "label"=>"estado_id");

$grupo = "general";

$campos[$grupo]= $campos_item;
unset($campos_item);






/**
 * Apartir de aca, puedes configurar otros campos
 */
