<?PHP
/**
 * Configuramos todas los grupos de campos, para creación y verificación de formulaios
 */
$fields = array();
/***
 * Configuraciòn de los grupos de campos a utilizar
 */
$field_item = array();

$field_item["departamento_id"]=array("type"=>"text");
$field_item["municipio_id"]=array("type"=>"text");
$field_item["provincia"]=array("type"=>"text");
$field_item["distrito"]=array("type"=>"text");
$field_item["comunidad"]=array("type"=>"text");
$field_item["participacion"]=array("type"=>"text");

//$field_item["active"]=array("type"=>"checkbox_02");
$group = "index";
$fields[$group]= $field_item;
unset($field_item);

/**
 * Formulario principal
 */

$field_item = array();
//**********Location
$field_item["location_latitude_decimal"]=array("type"=>"text");
$field_item["location_longitude_decimal"]=array("type"=>"text");

$group = "module";
$fields[$group]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
