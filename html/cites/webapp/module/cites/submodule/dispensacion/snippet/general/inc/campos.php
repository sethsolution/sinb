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


$campos_item["tipo_id"]=array(
    "tipo"=>"text"
,   "label"=>"tipo_id");


$campos_item["fecha_expiracion"]=array(
    "tipo"=>"date_01"
,   "label"=>"Programa");

$campos_item["importador_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"Código");

$campos_item["importador_direccion"]=array(
    "tipo"=>"text"
,   "label"=>"Nombre de Convenio");

$campos_item["exportador_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"Cartera");

$campos_item["exportador_direccion"]=array(
    "tipo"=>"text"
,   "label"=>"Cartera");

$campos_item["exportador_pais_id"]=array(
    "tipo"=>"text"
,   "label"=>"Cartera");

$campos_item["importacion_pais_id"]=array(
    "tipo"=>"text"
,   "label"=>"Cartera");

$campos_item["condiciones_especiales"]=array(
    "tipo"=>"text"
,   "label"=>"condiciones_especiales");

$campos_item["tipo_documento_id"]=array(
    "tipo"=>"text"
,   "label"=>"text");

$campos_item["proposito_id"]=array(
    "tipo"=>"text"
,   "label"=>"text");

$campos_item["numero_estampilla"]=array(
    "tipo"=>"text"
,   "label"=>"text");

$campos_item["autoridad_administrativa"]=array(
    "tipo"=>"text"
,   "label"=>"text");

$campos_item["emitido_lugar"]=array(
    "tipo"=>"text"
,   "label"=>"text");

$campos_item["emitido_fecha"]=array(
    "tipo"=>"date_01"
,   "label"=>"Programa");

$campos_item["dispensacion_tipo"]=array(
    "tipo"=>"text"
,   "label"=>"dispensacion_tipo");

$campos_item["puerto_embarque"]=array(
    "tipo"=>"text"
,   "label"=>"puerto_embarque");

$grupo = "general";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
