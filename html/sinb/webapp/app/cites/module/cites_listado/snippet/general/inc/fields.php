<?PHP
/**
 * Configuramos todas los grupos de campos, para creación y verificación de formulaios
 */

/**
 * Arreglos que se utilizaran en esta configuración para guardar los grupos de campos
 */
$fields = array();

/***
 * Configuraciòn de los grupos de campos a utilizar
 */
$field_item = array();
$field_item["fecha"]=array("type"=>"date_01");
$field_item["tipo_documento_id"]=array("type"=>"text");
$field_item["numero_cites"]=array("type"=>"text");
$field_item["exportador"]=array("type"=>"text");
$field_item["destinatario"]=array("type"=>"text");
$field_item["proposito_id"]=array("type"=>"text");
$field_item["fecha_valido"]=array("type"=>"date_01");
$field_item["observacion"]=array("type"=>"text");

$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
