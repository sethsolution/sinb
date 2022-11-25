<?PHP
/**
 * Configuramos todas los grupos de campos, para creación y verificación de formulaios
 */
$fields = array();
/***
 * Configuraciòn de los grupos de campos a utilizar
 */
$field_item = array();
$field_item["apendice_id"]=array("type"=>"text");
$field_item["nombre_comercial"]=array("type"=>"text");
$field_item["nombre_cientifico"]=array("type"=>"text");
$field_item["numero_cantidad"]=array("type"=>"text");
$field_item["unidad_id"]=array("type"=>"text");
$field_item["origen_id"]=array("type"=>"text");
$field_item["descripcion"]=array("type"=>"text");

$group = "index";
$fields[$group]= $field_item;
unset($field_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */
