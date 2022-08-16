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

$campos_item["papmp_especie1_id"]=array(
    "tipo"=>"text"
,   "label"=>"papmp_especie1_id");
$campos_item["papmp_especie1_cantidad"]=array(
    "tipo"=>"text"
,   "label"=>"papmp_especie1_cantidad");
$campos_item["papmp_especie1_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"papmp_especie1_nombre");

$campos_item["papmp_especie2_id"]=array(
    "tipo"=>"text"
,   "label"=>"papmp_especie2_id");
$campos_item["papmp_especie2_cantidad"]=array(
    "tipo"=>"text"
,   "label"=>"papmp_especie2_cantidad");
$campos_item["papmp_especie2_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"papmp_especie2_nombre");


$campos_item["papmp_especie3_id"]=array(
    "tipo"=>"text"
,   "label"=>"papmp_especie3_id");
$campos_item["papmp_especie3_cantidad"]=array(
    "tipo"=>"text"
,   "label"=>"papmp_especie3_cantidad");
$campos_item["papmp_especie3_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"papmp_especie3_nombre");

$campos_item["aacn_ra"]=array(
    "tipo"=>"text"
,   "label"=>"aacn_ra");
$campos_item["aacn_fecha_emision"]=array(
    "tipo"=>"date_01"
,   "label"=>"aacn_fecha_emision");
$campos_item["aacn_fecha_caducidad"]=array(
    "tipo"=>"date_01"
,   "label"=>"aacn_fecha_caducidad");

$campos_item["papmp_anio"]=array(
    "tipo"=>"text"
,   "label"=>"papmp_anio");
$campos_item["papmp_empresa"]=array(
    "tipo"=>"text"
,   "label"=>"papmp_empresa");

$campos_item["lagarto_fecha_emision"]=array(
    "tipo"=>"date_01"
,   "label"=>"lagarto_fecha_emision");
$campos_item["lagarto_fecha_caducidad"]=array(
    "tipo"=>"date_01"
,   "label"=>"lagarto_fecha_caducidad");

$campos_item["ica_ra"]=array(
    "tipo"=>"text"
,   "label"=>"ica_ra");
$campos_item["ica_fecha_emision"]=array(
    "tipo"=>"date_01"
,    "label"=>"ica_fecha_emision");
$campos_item["ica_fecha_caducidad"]=array(
    "tipo"=>"date_01"
,   "label"=>"ica_fecha_caducidad");

$campos_item["estado_id"]=array(
    "tipo"=>"date_01"
,   "label"=>"estado_id");




$grupo = "general";

$campos[$grupo]= $campos_item;
unset($campos_item);






/**
 * Apartir de aca, puedes configurar otros campos
 */
