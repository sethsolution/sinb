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
//*******Identificacion del consumidor rgula solicitante
$field_item["numero_registro"]=array("type"=>"text");
$field_item["nombre"]=array("type"=>"text");
$field_item["nit"]=array("type"=>"text");
$field_item["red_id"]=array("type"=>"text");
$field_item["actividad_id"]=array("type"=>"text");
$field_item["actividad"]=array("type"=>"text");
$field_item["representante_legal"]=array("type"=>"text");
$field_item["comentario"]=array("type"=>"text");
$field_item["vigente"]=array("type"=>"checkbox_02");
$field_item["fecha_inscripcion"]=array("type"=>"date_01");
$field_item["fecha_expiracion"]=array("type"=>"date_01");

$field_item["departamento"]=array("type"=>"text");
$field_item["departamento_id"]=array("type"=>"text");

$field_item["direccion"]=array("type"=>"text");
$field_item["telefono"]=array("type"=>"text");
$field_item["email"]=array("type"=>"text");
$field_item["numero_registro"]=array("type"=>"text");
$field_item["comentario_observaciones"]=array("type"=>"text");


$field_item["fecha_conclusion"]=array("type"=>"date_01");


$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
