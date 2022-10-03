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


$campos_item["total_carne"]=array(
    "tipo"=>"text"
,   "label"=>"Nombre");

$campos_item["total_charque"]=array(
    "tipo"=>"text"
,   "label"=>"Descripción");

$campos_item["representante_legal_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"Descripción");
$campos_item["responsable_curtiembre_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"Descripción");
$campos_item["comunidad"]=array(
    "tipo"=>"text"
,   "label"=>"Comunidad");
$campos_item["entregado_carne_primera"]=array(
    "tipo"=>"text"
,   "label"=>"Nombre");
$campos_item["entregado_carne_segunda"]=array(
    "tipo"=>"text"
,   "label"=>"Nombre");

$campos_item["entregado_charque"]=array(
    "tipo"=>"text"
,   "label"=>"Descripción");
$campos_item["estado"]=array(
    "tipo"=>"text"
,   "label"=>"Descripción");

$campos_item["gestion_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"Descripción");

$campos_item["id_acta_fisica"]=array(
    "tipo"=>"text"
,   "label"=>"IdActa");


$grupo = "acta_carne";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
