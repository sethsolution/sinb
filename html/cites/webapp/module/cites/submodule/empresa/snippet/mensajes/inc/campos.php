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



$campos_item["mensaje"]=array(
    "tipo"=>"text"
,   "label"=>"Mensaje");

$campos_item["dateUpdate"]=array(
    "tipo"=>"date_01"
,   "label"=>"fecha");


$grupo = "index";
$campos[$grupo]= $campos_item;
unset($campos_item);


/**
 * Apartir de aca, puedes configurar otros campos
 */
