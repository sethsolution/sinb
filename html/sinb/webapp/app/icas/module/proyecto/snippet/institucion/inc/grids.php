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
    "table" => $appVars["table"] ["icas_institucion_tipo"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "t" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"tipo_id" //Campo de relación en la tabla principal
);
/**
 * Configuración de los campos que mostraremos en la grilla
 */

$grid_item[]=array("field" => "nombre","label"=> $smarty->config_vars["table_nombre"]);

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_tipo"]
, "table_as"=> "t", "as" => "icas_institucion_tipo");

$grid_item[]=array("field" => "direccion","label"=> $smarty->config_vars["table_direccion"]);
$grid_item[]=array("field" => "telefono","label"=> $smarty->config_vars["table_telefono"]);
$grid_item[]=array("field" => "fax","label"=> $smarty->config_vars["table_fax"]);
$grid_item[]=array("field" => "celular","label"=> $smarty->config_vars["table_celular"]);
$grid_item[]=array("field" => "email","label"=> $smarty->config_vars["table_email"]);
$grid_item[]=array("field" => "responsable","label"=> $smarty->config_vars["table_responsable"]);
$grid_item[]=array("field" => "responsable_operativo","label"=> $smarty->config_vars["table_responsable_operativo"]);

$grid_item[]=array("field" => "created_at","label"=> $smarty->config_vars["gl_table_created_at"]);
$grid_item[]=array("field" => "updated_at","label"=> $smarty->config_vars["gl_table_updated_at"]);


$group = "index";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);
