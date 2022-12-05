<?PHP
/**
 * Configuramos todas los grupos de campos, para creación y verificación de formulaios
 */
$fields = array();
/***
 * Configuraciòn de los grupos de campos a utilizar
 */
$field_item = array();
$field_item["inscripcion"]=array("type"=>"text");
$field_item["fecha_acreditacion"]=array("type"=>"date_01");
$field_item["fecha_expiracion"]=array("type"=>"date_01");
$field_item["descripcion"]=array("type"=>"text");

$group = "index";
$fields[$group]= $field_item;
unset($field_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */
