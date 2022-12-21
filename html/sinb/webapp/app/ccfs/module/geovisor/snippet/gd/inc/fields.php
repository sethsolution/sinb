<?PHP
/**
 * Configuramos todas los grupos de campos, para creación y verificación de formulaios
 */
$fields = array();
/***
 * Configuraciòn de los grupos de campos a utilizar
 */
$field_item = array();
$field_item["nombre_depositante"]=array("type"=>"text");
$field_item["monto"]=array("type"=>"text");
$field_item["numero_boleta"]=array("type"=>"text");
$field_item["fecha_pago"]=array("type"=>"date_01");

$field_item["active"]=array("type"=>"checkbox_02");
$group = "index";
$fields[$group]= $field_item;
unset($field_item);

/**
 * Apartir de aca, puedes configurar otros campos
 */
