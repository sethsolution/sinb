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
$field_item["nombre"]=array("type"=>"text");
$field_item["descripcion"]=array("type"=>"text");
$field_item["active"]=array("type"=>"checkbox_02");

$group = "index";
$fields[$group]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
