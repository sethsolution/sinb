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

$campos_item["nombres"]=array(
    "tipo"=>"text"
,   "label"=>"Nombres");

$campos_item["apellido_paterno"]=array(
    "tipo"=>"text"
,   "label"=>"Apelido Paterno");

$campos_item["apellido_materno"]=array(
    "tipo"=>"text"
,   "label"=>"Apellido Materno");

$campos_item["apellido_casada"]=array(
    "tipo"=>"text"
,   "label"=>"Apellido Casada");

$campos_item["profesional"]=array(
    "tipo"=>"text"
,   "label"=>"profesional");

$campos_item["correo_electronico"]=array(
    "tipo"=>"text"
,   "label"=>"Correo electrónico");

$campos_item["fecha_nacimiento"]=array(
    "tipo"=>"date_01" // Manejo de fecha formato: dd/mm/yyyyy
,   "label"=>"Fecha de Nacimiento");

$campos_item["genero_id"]=array(
    "tipo"=>"select"
,   "label"=>"Genero");

$campos_item["ci"]=array(
    "tipo"=>"text"
,   "label"=>"Carnet de Identidad:");

$campos_item["ci_exp"]=array(
    "tipo"=>"select"
,   "label"=>"Carnet de Identidad:");

$campos_item["direccion"]=array(
    "tipo"=>"text"
,   "label"=>"Dirección");

$campos_item["estado_civil_id"]=array(
    "tipo"=>"text"
,   "label"=>"Dirección");

$campos_item["grupo_sanguineo_id"]=array(
    "tipo"=>"text"
,   "label"=>"Dirección");



$campos_item["afp_id"]=array(
    "tipo"=>"text"
,   "label"=>"Dirección");

$campos_item["nua"]=array(
    "tipo"=>"text"
,   "label"=>"Dirección");



$campos_item["institucion_financiera_id"]=array(
    "tipo"=>"text"
,   "label"=>"Dirección");

$campos_item["numero_cuenta"]=array(
    "tipo"=>"text"
,   "label"=>"Dirección");


$grupo = "datos_general";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */


