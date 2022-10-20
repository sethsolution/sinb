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
$field_item["nombre"]=array("type"=>"text");
$field_item["sigla"]=array("type"=>"text");
//field_item["telefono"]=array("type"=>"checkbox_02");
$field_item["descripcion"]=array("type"=>"text");
$field_item["fecha_registro"]=array("type"=>"date_01");
$field_item["co_ejecutor"]=array("type"=>"text");
$field_item["norma_id"]=array("type"=>"text");
$field_item["estado_id"]=array("type"=>"text");
$field_item["plazo_vigencia"]=array("type"=>"text");
$field_item["proyecto_preinversion"]=array("type"=>"text");
$field_item["proyecto_inversion"]=array("type"=>"text");

$field_item["avance_financiero"]=array("type"=>"text");
$field_item["avance_fisico"]=array("type"=>"text");


$field_item["fecha_inicio"]=array("type"=>"date_01");
$field_item["fecha_conclusion"]=array("type"=>"date_01");
$field_item["fecha_conclusion_enmienda"]=array("type"=>"date_01");


$field_item["vigencia_anios"]=array("type"=>"text");
$field_item["vigencia_mes"]=array("type"=>"text");
$field_item["vigencia_dias"]=array("type"=>"text");

$field_item["moneda_id"]=array("type"=>"text");

$field_item["monto"]=array("type"=>"text");
$field_item["monto_bs"]=array("type"=>"text");


$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
