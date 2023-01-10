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
$field_item["mes"]=array("type"=>"text");
$field_item["fecha"]=array("type"=>"date_01");
$field_item["gestion"]=array("type"=>"text");
$field_item["procedencia"]=array("type"=>"text");
$field_item["especie_id"]=array("type"=>"text");
$field_item["cantidad"]=array("type"=>"text");
$field_item["destino"]=array("type"=>"text");
$field_item["categoria_id"]=array("type"=>"text");
$field_item["observaciones"]=array("type"=>"text");
$field_item["estado_salud_id"]=array("type"=>"text");
$field_item["destino_id"]=array("type"=>"text");
$field_item["procedencia_id"]=array("type"=>"text");
$field_item["entregado"]=array("type"=>"text");

$field_item["departamento"]=array("type"=>"text");
$field_item["departamento_id"]=array("type"=>"text");

$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
