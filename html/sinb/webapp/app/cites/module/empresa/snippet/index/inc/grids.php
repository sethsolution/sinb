<?PHP
/**
 * Configuramos todas las grillas que utilizaremos en este snippet
 */
$grid = array();
$grid_table_join = array();

\Core\Core::setLenguage("tableIndex"); //cargamos idioma
/**
 * Configuración de tablas relacionales, (JOIN)
 */
$grid_table[] = array(
    "table" => $appVars["table"] ["empresa_estado"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "e" //Alias de la tabla para el join
,   "field_id"=>"itemId" //Id de la tabla que hara la relación
,   "relationship_id"=>"estado_id" //Campo de relación en la tabla principal
);
//print_struc($appVars["table"]);exit;
$grid_table[] = array(
    "table" => $appVars["table"] ["departamento"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "d" //Alias de la tabla para el join
,   "field_id"=>"itemId" //Id de la tabla que hara la relación
,   "relationship_id"=>"representante_legal_ci_exp" //Campo de relación en la tabla principal
);

$grid_table[] = array(
    "table" => $appVars["table"] ["usuario"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "u" //Alias de la tabla para el join
,   "field_id"=>"itemId" //Id de la tabla que hara la relación
,   "relationship_id"=>"usuario_id" //Campo de relación en la tabla principal
);


/**
 * Configuración de los campos que mostraremos en la grilla
 */
$grid_item[]=array( "field" => "usuario", "label"=> $smarty->config_vars["table_usuario"]
, "table_as"=> "u", "as" => "usuario");
$grid_item[]=array( "field" => "activo", "label"=> $smarty->config_vars["table_activo"]
, "table_as"=> "u", "as" => "usuario_activo");
$grid_item[]=array( "field" => "dateCreate", "label"=> $smarty->config_vars["table_datecreate"]
, "table_as"=> "u", "as" => "usuario_datecreate");
$grid_item[]=array( "field" => "verifica_email", "label"=> $smarty->config_vars["table_verificaemail"]
, "table_as"=> "u", "as" => "usuario_verificaemail");
$grid_item[]=array( "field" => "verifica_fecha", "label"=> $smarty->config_vars["table_verificafecha"]
, "table_as"=> "u", "as" => "usuario_verificafecha");



$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_estado"]
, "table_as"=> "e", "as" => "estado");

$grid_item[]=array("field"=> "nombre", "label"=> $smarty->config_vars["table_nombre"]);
$grid_item[]=array("field" => "representante_legal_nombre","label"=> $smarty->config_vars["table_representante_legal_nombre"]);
$grid_item[]=array("field" => "representante_legal_paterno","label"=> $smarty->config_vars["table_representante_legal_paterno"]);
$grid_item[]=array("field" => "representante_legal_materno","label"=> $smarty->config_vars["table_representante_legal_materno"]);


$grid_item[]=array("field" => "representante_legal_ci","label"=> $smarty->config_vars["table_representante_legal_ci"]);
$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_expedido"]
, "table_as"=> "d", "as" => "expedido");

$grid_item[]=array("field" => "representante_legal_telefono","label"=> $smarty->config_vars["table_representante_legal_telefono"]);
$grid_item[]=array("field"=> "email", "label"=> $smarty->config_vars["table_email"]);




$grid_item[]=array("field"=> "direccion", "label"=> $smarty->config_vars["table_direccion"]);
$grid_item[]=array("field"=> "nit", "label"=> $smarty->config_vars["table_nit"]);
$grid_item[]=array("field"=> "enviado_fecha", "label"=> $smarty->config_vars["table_enviado_fecha"]);
$grid_item[]=array("field"=> "aprobado_fecha", "label"=> $smarty->config_vars["table_aprobado_fecha"]);
$grid_item[]=array("field" => "dateCreate","label"=> $smarty->config_vars["gl_table_created_at"]);
$grid_item[]=array("field" => "dateUpdate","label"=> $smarty->config_vars["gl_table_updated_at"]);


$group = "item";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);
/**
 * A partir de aca puede añadir todas las grillas que sean necesarias para esta vista
 */
/*/
print_struc($grid_table_join);
print_struc($grid);
exit;
/**/