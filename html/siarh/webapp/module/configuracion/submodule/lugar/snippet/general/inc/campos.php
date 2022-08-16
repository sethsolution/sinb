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

$campos_item["entidad_id"]=array(
    "tipo"=>"text"
,   "label"=>"Entidad");

$campos_item["nombre"]=array(
    "tipo"=>"text"
,   "label"=>"Nombre");

$campos_item["direccion"]=array(
    "tipo"=>"text"
,   "label"=>"Direccion");

$campos_item["latitud"]=array(
    "tipo"=>"text"
,   "label"=>"Latitud");

$campos_item["longitud"]=array(
    "tipo"=>"text"
,   "label"=>"Longitud");

$campos_item["telefonos"]=array(
    "tipo"=>"text"
,   "label"=>"Telefonos");

$campos_item["adjunto_tipo"]=array(
    "tipo"=>"text"
,   "label"=>"Tipo");

$grupo = "lugar";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
