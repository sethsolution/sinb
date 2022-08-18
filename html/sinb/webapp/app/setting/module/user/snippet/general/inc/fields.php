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
$field_item["active"]=array("type"=>"checkbox_02");
$field_item["name"]=array("type"=>"text");
$field_item["last_name"]=array("type"=>"text");
$field_item["mobile"]=array("type"=>"text");
$field_item["phone"]=array("type"=>"text");
$field_item["username"]=array("type"=>"text");
$field_item["password"]=array("type"=>"text");
$field_item["description"]=array("type"=>"text");
$field_item["type"]=array("type"=>"text");

$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
