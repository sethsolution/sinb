<?PHP
/**
 * Configuramos todas los grupos de campos, para creación y verificación de formulaios
 */
$fields = array();
/***
 * Configuraciòn de los grupos de campos a utilizar
 */
$field_item = array();
$field_item["gestion_id"]=array("type"=>"text");
$field_item["especie_tipo_id"]=array("type"=>"text");
$field_item["especie"]=array("type"=>"text");
$field_item["numero_animales_albergar"]=array("type"=>"text");
$field_item["numero_animales_gestion"]=array("type"=>"text");
$field_item["nacimientos"]=array("type"=>"text");
$field_item["ingreso_recepcion"]=array("type"=>"text");
$field_item["transferencia_de_ccfs"]=array("type"=>"text");
$field_item["decesos"]=array("type"=>"text");
$field_item["fugas"]=array("type"=>"text");
$field_item["transferencia_a_ccfs"]=array("type"=>"text");
$field_item["total_albergados"]=array("type"=>"text");
$field_item["descripcion"]=array("type"=>"text");

$group = "index";
$fields[$group]= $field_item;
unset($field_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */
