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
$campos_item["descripcion"]=array(
    "tipo"=>"text"
,   "label"=>"descripcion");

$grupo = "archivo";

$campos[$grupo]= $campos_item;
unset($campos_item);

$campos_item = array();

$campos_item["publicacion_fecha_fin"]=array(
    "tipo"=>"date_01"
,   "label"=>"publicacion_fecha_fin");

$campos_item["publicacion_fecha_inicio"]=array(
    "tipo"=>"date_01"
,   "label"=>"publicacion_fecha_inicio");

$grupo = "general";

$campos[$grupo]= $campos_item;
unset($campos_item);






/**
 * Apartir de aca, puedes configurar otros campos
 */
