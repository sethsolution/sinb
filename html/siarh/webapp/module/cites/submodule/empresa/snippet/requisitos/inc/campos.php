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
$campos_item["observacion"]=array(
    "tipo"=>"text"
,   "label"=>"observacion");

$campos_item["estado_id"]=array(
    "tipo"=>"text"
,   "label"=>"estado_id");

$grupo = "archivo";
$campos[$grupo]= $campos_item;
unset($campos_item);

/**
 * -----------------------------------------------------------------------------------
 */

$campos_item = array();
$campos_item["requisitos_observado"]=array(
    "tipo"=>"checkbox_01"
,   "label"=>"requisitos_observado");
$campos_item["requisitos_observacion"]=array(
    "tipo"=>"text"
,   "label"=>"requisitos_observacion");

$grupo = "general";
$campos[$grupo]= $campos_item;
unset($campos_item);



/**
 * Apartir de aca, puedes configurar otros campos
 */
