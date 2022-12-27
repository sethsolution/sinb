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
$field_item["nombre"]=array("type"=>"text");
$field_item["codigo"]=array("type"=>"text");
$field_item["categoria_id"]=array("type"=>"text");
$field_item["condicion"]=array("type"=>"text");
$field_item["departamento_id"]=array("type"=>"text");
$field_item["municipio_id"]=array("type"=>"text");
$field_item["licencia_funcionamiento"]=array("type"=>"text");
$field_item["formato"]=array("type"=>"text");
$field_item["fecha_emision"]=array("type"=>"date_01");
$field_item["fecha_conclusion"]=array("type"=>"date_01");
$field_item["superficie"]=array("type"=>"text");
$field_item["responsable"]=array("type"=>"text");

$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
