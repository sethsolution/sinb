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



$campos_item["nombre_depositante"]=array(
    "tipo"=>"text"
,   "label"=>"nombre_depositante");

$campos_item["numero_boleta"]=array(
    "tipo"=>"text"
,   "label"=>"numero_boleta");

$campos_item["monto"]=array(
    "tipo"=>"text"
,   "label"=>"monto");

$campos_item["fecha_pago"]=array(
    "tipo"=>"date_01"
,   "label"=>"fecha_pago");

$grupo = "archivo";
$campos[$grupo]= $campos_item;
unset($campos_item);


/**
 * Apartir de aca, puedes configurar otros campos
 */
