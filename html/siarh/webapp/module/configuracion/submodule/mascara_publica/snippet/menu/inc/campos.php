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
,   "label"=>"Nombre");

$campos_item["class"]=array(
    "tipo"=>"text"
,   "label"=>"Class");

$campos_item["tipo"]=array(
    "tipo"=>"text"
,   "label"=>"Tipo");

$campos_item["submodulo_id"]=array(
    "tipo"=>"text"
,   "label"=>"SubModulo id");

$campos_item["modulo_id"]=array(
    "tipo"=>"text"
,   "label"=>"Modulo id");

$campos_item["url"]=array(
    "tipo"=>"text"
,   "label"=>"Url");

$campos_item["target"]=array(
    "tipo"=>"checkbox_01"
,   "label"=>"Target");

$campos_item["orden"]=array(
    "tipo"=>"text"
,   "label"=>"Orden");

$grupo = "archivo";
$campos[$grupo]= $campos_item;
unset($campos_item);


/**
 * Apartir de aca, puedes configurar otros campos
 */
