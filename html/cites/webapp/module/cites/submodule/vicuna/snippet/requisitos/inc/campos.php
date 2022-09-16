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

$campos_item["unidad_id"]=array(
    "tipo"=>"text"
,   "label"=>"unidad_id");

$campos_item["venta_monto"]=array(
    "tipo"=>"text"
,   "label"=>"venta_monto");

$campos_item["venta_monto_usd"]=array(
    "tipo"=>"text"
,   "label"=>"venta_monto_usd");

$campos_item["venta_cantidad"]=array(
    "tipo"=>"text"
,   "label"=>"venta_cantidad");

$campos_item["fundempresa_fecha_emision"]=array(
    "tipo"=>"date_01"
,   "label"=>"fundempresa_fecha_emision");

$campos_item["fundempresa_fecha_caducidad"]=array(
    "tipo"=>"date_01"
,   "label"=>"fundempresa_fecha_caducidad");

$campos_item["fundempresa_registro"]=array(
    "tipo"=>"text"
,   "label"=>"fundempresa_registro");

$campos_item["representante_legal_ci_exp"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_ci_exp");

$campos_item["representante_legal_ci"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_ci");

$campos_item["representante_legal_paterno"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_paterno");

$campos_item["representante_legal_materno"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_materno");

$campos_item["representante_legal_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_nombre");

$campos_item["fecha_emision"]=array(
    "tipo"=>"date_01"
,    "label"=>"fecha_emision");

$campos_item["fecha_caducidad"]=array(
    "tipo"=>"date_01"
,    "label"=>"fecha_caducidad");

$campos_item["observacion"]=array(
    "tipo"=>"text"
,   "label"=>"observacion");

$campos_item["empresa_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"empresa_nombre");

$campos_item["cites_numero"]=array(
    "tipo"=>"text"
,   "label"=>"cites_numero");

$campos_item["cites_fecha_emision"]=array(
    "tipo"=>"date_01"
,   "label"=>"cites_fecha_emision");

$campos_item["fecha_caducidad_ci"]=array(
    "tipo"=>"date_01"
,   "label"=>"fecha_caducidad_ci");

$grupo = "general";

$campos[$grupo]= $campos_item;
unset($campos_item);






/**
 * Apartir de aca, puedes configurar otros campos
 */
