<?PHP
/**
 * Configuramos todas los grupos de campos, para creación y verificación de formulaios
 */

$fields = array();
/***
 * Configuraciòn de los grupos de campos a utilizar
 */
$field_item = array();
$field_item["app_group_id"]=array("type"=>"text");
$field_item["name"]=array("type"=>"text");
$field_item["class"]=array("type"=>"text");
$field_item["active"]=array("type"=>"checkbox_02");
$field_item["target"]=array("type"=>"checkbox_02");
$field_item["order"]=array("type"=>"text");
$field_item["type"]=array("type"=>"text");
$field_item["url"]=array("type"=>"text");
$field_item["folder"]=array("type"=>"text");
$field_item["description"]=array("type"=>"text");
$field_item["url"]=array("type"=>"text");

$group = "index";
$fields[$group]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
