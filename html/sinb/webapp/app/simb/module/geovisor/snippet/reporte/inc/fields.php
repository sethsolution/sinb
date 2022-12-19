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
$field_item["estado"]=array("type"=>"checkbox_02");
$field_item["nombre"]=array("type"=>"text");
$field_item["sigla"]=array("type"=>"text");
$field_item["actividad"]=array("type"=>"text");
$field_item["licencia"]=array("type"=>"text");

$field_item["sistema"]=array("type"=>"text");
$field_item["descripcion"]=array("type"=>"text");

$field_item["ciae"]=array("type"=>"text");


$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
