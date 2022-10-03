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


$campos_item["total_chalecos"]=array(
    "tipo"=>"text"
,   "label"=>"Nombre");

$campos_item["representante_legal_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"Descripción");
$campos_item["cazador_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"Descripción");
$campos_item["total_colas"]=array(
    "tipo"=>"text"
,   "label"=>"Total Colas");
$campos_item["comunidad"]=array(
    "tipo"=>"text"
,   "label"=>"Comunidad");
$campos_item["fecha_acta"]=array(
    "tipo"=>"text"
,   "label"=>"Fecha Acta");
$campos_item["gestion_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"Gestion");




$grupo = "tco_custodia_cuero";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
