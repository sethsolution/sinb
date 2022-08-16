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

$campos_item["nombre"]=array(
    "tipo"=>"text"
,   "label"=>"Nombres");

$campos_item["apellido"]=array(
    "tipo"=>"text"
,   "label"=>"Apelido Paterno");

$campos_item["telefono"]=array(
    "tipo"=>"text"
,   "label"=>"Apellido Materno");

$campos_item["celular"]=array(
    "tipo"=>"text"
,   "label"=>"Apellido Casada");

$campos_item["direccion"]=array(
    "tipo"=>"text"
,   "label"=>"profesional");

$campos_item["email"]=array(
    "tipo"=>"text"
,   "label"=>"Correo electrónico");


$grupo = "datos_general";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */


