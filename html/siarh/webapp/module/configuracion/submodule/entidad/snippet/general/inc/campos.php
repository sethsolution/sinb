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
$campos_item["activo"]=array(
    "tipo"=>"checkbox_01" //si es de este tipo, si o si guarda a la base de datos con 1 o 0
,   "label"=>"Activo");

$campos_item["nombre"]=array(
    "tipo"=>"text"
,   "label"=>"nombre");

$campos_item["sigla"]=array(
    "tipo"=>"text"
,   "label"=>"sigla");

$campos_item["cod1"]=array(
    "tipo"=>"text"
,   "label"=>"cod1");

$campos_item["cod2"]=array(
    "tipo"=>"text"
,   "label"=>"cod2");

$campos_item["cod3"]=array(
    "tipo"=>"text"
,   "label"=>"cod3");

$campos_item["cod4"]=array(
    "tipo"=>"text"
,   "label"=>"cod4");


$grupo = "entidad";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
