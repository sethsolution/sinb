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

$campos_item["itemId"]=array(
    "tipo"=>"text"
,   "label"=>"ID");

$campos_item["moduloId"]=array(
    "tipo"=>"text"
,   "label"=>"Módulo ID");

$campos_item["nombre"]=array(
    "tipo"=>"text"
,   "label"=>"Nombre");

$campos_item["descripcion"]=array(
    "tipo"=>"text"
,   "label"=>"Descripción");

$campos_item["carpeta"]=array(
    "tipo"=>"text"
,   "label"=>"Carpeta");

$campos_item["orden"]=array(
    "tipo"=>"text"
,   "label"=>"Posición Ficha");

$campos_item["parent"]=array(
    "tipo"=>"number"
,   "label"=>"Relación Módulo");

$campos_item["class"]=array(
    "tipo"=>"text"
,   "label"=>"Asignación Icono");

$campos_item["principal"]=array(
    "tipo"=>"checkbox_01" //si es de este tipo, si o si guarda a la base de datos con 1 o 0
,   "label"=>"principal");

$grupo = "submodulo";
$campos[$grupo]= $campos_item;
unset($campos_item);


/**
 * Apartir de aca, puedes configurar otros campos
 */
