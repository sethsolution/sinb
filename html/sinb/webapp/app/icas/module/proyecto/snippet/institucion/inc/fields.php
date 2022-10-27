<?PHP
/**
 * Configuramos todas los grupos de campos, para creación y verificación de formulaios
 */
$fields = array();
/***
 * Configuraciòn de los grupos de campos a utilizar
 */
$field_item = array();
$field_item["nombre"]=array("type"=>"text");
$field_item["institucion_id"]=array("type"=>"text");
$field_item["tipo_id"]=array("type"=>"text");
$field_item["direccion"]=array("type"=>"text");
$field_item["telefono"]=array("type"=>"text");
$field_item["fax"]=array("type"=>"text");
$field_item["celular"]=array("type"=>"text");
$field_item["email"]=array("type"=>"text");
$field_item["responsable"]=array("type"=>"text");
$field_item["responsable_operativo"]=array("type"=>"text");
$field_item["active"]=array("type"=>"checkbox_02");
$group = "index";
$fields[$group]= $field_item;
unset($field_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */
