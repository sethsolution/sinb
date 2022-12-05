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
$field_item["vigente"]=array("type"=>"checkbox_02");
$field_item["nombre"]=array("type"=>"text");
$field_item["tipo_id"]=array("type"=>"text");
$field_item["direccion"]=array("type"=>"text");
$field_item["telefono"]=array("type"=>"text");
$field_item["fax"]=array("type"=>"text");
$field_item["celular"]=array("type"=>"text");
$field_item["email"]=array("type"=>"text");
$field_item["web"]=array("type"=>"text");
$field_item["pais_id"]=array("type"=>"text");
$field_item["departamento_id"]=array("type"=>"text");
$field_item["ciudad"]=array("type"=>"text");
$field_item["responsable"]=array("type"=>"text");
$field_item["responsable_operativo"]=array("type"=>"text");
$field_item["fecha_acreditacion"]=array("type"=>"date_01");
$field_item["fecha_expiracion"]=array("type"=>"date_01");
//$field_item["active"]=array("type"=>"checkbox_02");


$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
