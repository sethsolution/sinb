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




$campos_item["ini_caza"]=array(
    "tipo"=>"date_01"
,   "label"=>"Gestion");
$campos_item["fin_caza"]=array(
    "tipo"=>"date_01"
,   "label"=>"Gestion");
$campos_item["ini_movilizacion"]=array(
    "tipo"=>"date_01"
,   "label"=>"Gestion");
$campos_item["fin_movilizacion"]=array(
    "tipo"=>"date_01"
,   "label"=>"Gestion");

$grupo = "gestion";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
