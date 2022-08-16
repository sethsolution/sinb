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

$campos_item["password"]=array(
    "tipo"=>"text"
,   "label"=>"Password");

$campos_item["password1"]=array(
    "tipo"=>"text"
,   "label"=>"Password");

$campos_item["password2"]=array(
    "tipo"=>"text"
,   "label"=>"Password");

$campos_item["password3"]=array(
    "tipo"=>"text"
,   "label"=>"Password");

$campos_item["apellido"]=array(
    "tipo"=>"text"
,   "label"=>"Apelido Paterno");




$grupo = "datos_general";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */


