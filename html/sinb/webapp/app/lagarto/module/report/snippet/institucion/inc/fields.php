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


$field_item["tipo_id"]=array("type"=>"text");
$field_item["convenio_id"]=array("type"=>"text");
$field_item["nombre"]=array("type"=>"text");

$field_item["estado_id"]=array("type"=>"text");
$field_item["estado_detallado"]=array("type"=>"text");


$field_item["programa_id"]=array("type"=>"text");
$field_item["programa_convenio_id"]=array("type"=>"text");


$field_item["objetivo_general"]=array("type"=>"text");
$field_item["objetivo_especifico"]=array("type"=>"text");
$field_item["metas"]=array("type"=>"text");


$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
