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
$field_item["activo"]=array("type"=>"checkbox_01");
$field_item["ip"]=array("type"=>"text");
$field_item["descripcion"]=array("type"=>"text");
$field_item["lugar_id"]=array("type"=>"text");
$field_item["proveedor_id"]=array("type"=>"text");

$fields["c_ip_publica"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
**/