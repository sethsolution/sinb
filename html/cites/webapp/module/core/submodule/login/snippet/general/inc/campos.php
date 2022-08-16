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
$campos_item["ip"]=array(
    "tipo"=>"text"
,   "label"=>"IP");
$campos_item["descripcion"]=array(
    "tipo"=>"text"
,   "label"=>"Descripción");
$campos_item["lugar_id"]=array(
    "tipo"=>"text"
,   "label"=>"Lugar");
$campos_item["proveedor_id"]=array(
    "tipo"=>"text"
,   "label"=>"Proveedor");

$grupo = "c_ip_publica";
$campos[$grupo]= $campos_item;
unset($campos_item);

/**
 * Apartir de aca, puedes configurar otros campos

**/