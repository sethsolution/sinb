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
$field_item["codigo"]=array("type"=>"text");
$field_item["area_id"]=array("type"=>"text");
$field_item["estado_id"]=array("type"=>"text");
$field_item["departamento_id"]=array("type"=>"text");

$field_item["fuente_financiamiento_id"]=array("type"=>"text");
$field_item["fuente_financiamiento_otro"]=array("type"=>"text");

$field_item["antecedentes_justificacion"]=array("type"=>"text");
$field_item["objetivo_general"]=array("type"=>"text");
$field_item["objetivos_especificos"]=array("type"=>"text");
$field_item["resultados_esperados"]=array("type"=>"text");

$field_item["fecha_inicio"]=array("type"=>"date_01");
$field_item["fecha_conclusion"]=array("type"=>"date_01");


$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
