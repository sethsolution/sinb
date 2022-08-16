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



$campos_item["departamento_Id"]=array(
    "tipo"=>"text"
,   "label"=>"departamento_Id");

$campos_item["cupo_autorizado"]=array(
    "tipo"=>"text"
,   "label"=>"cupo_autorizado");

$campos_item["tco_id"]=array(
    "tipo"=>"text"
,   "label"=>"tco_id");

$campos_item["cupo_id"]=array(
    "tipo"=>"text"
,   "label"=>"cupo_id");

$campos_item["descripcion"]=array(
    "tipo"=>"text"
,   "label"=>"descripcion");

$grupo = "archivo";
$campos[$grupo]= $campos_item;
unset($campos_item);


/**
 * Apartir de aca, puedes configurar otros campos
 */
