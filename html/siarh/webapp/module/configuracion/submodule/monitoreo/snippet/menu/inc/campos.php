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
/*$campos_item["activo"]=array(
    "tipo"=>"checkbox_01" //si es de este tipo, si o si guarda a la base de datos con 1 o 0
,   "label"=>"Activo");*/

$campos_item["nombre"]=array(
    "tipo"=>"text"
,   "label"=>"Nombre");

$campos_item["siarh"]=array(
    "tipo"=>"checkbox_01"
,   "label"=>"Es SIARH");

$campos_item["ip_public"]=array(
    "tipo"=>"checkbox_01"
,   "label"=>"Público");

$campos_item["submodulo_id"]=array(
    "tipo"=>"text"
,   "label"=>"SubModulo");

$campos_item["lenguaje"]=array(
    "tipo"=>"text"
,   "label"=>"Lenguaje");

$campos_item["framework"]=array(
    "tipo"=>"text"
,   "label"=>"Framework");

$campos_item["estado_desa"]=array(
    "tipo"=>"text"
,   "label"=>"Estado Desarrollo");

$campos_item["responsable_desa"]=array(
    "tipo"=>"text"
,   "label"=>"Responsable");

$campos_item["estado_gest_datos"]=array(
    "tipo"=>"text"
,   "label"=>"Estado Gestion de Datos");

$campos_item["segui_gest_datos"]=array(
    "tipo"=>"text"
,   "label"=>"Seguimiento Gestion de Datos");

$grupo = "archivo";
$campos[$grupo]= $campos_item;
unset($campos_item);


/**
 * Apartir de aca, puedes configurar otros campos
 */
