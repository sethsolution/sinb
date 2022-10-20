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
    "table" => $appVars["table"] ["programa_estado"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "e" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"estado_id" //Campo de relación en la tabla principal
);
$grid_table[] = array(
    "table" => $appVars["table"] ["moneda"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "m" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"moneda_id" //Campo de relación en la tabla principal
);
/**
 * Configuración de los campos que mostraremos en la grilla
 */

$grid_item[]=array("field"=> "sigla", "label"=> $smarty->config_vars["table_sigla"]);
$grid_item[]=array("field" => "nombre","label"=> $smarty->config_vars["table_nombre"]);

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_estado"]
, "table_as"=> "e", "as" => "programa_estado");


$grid_item[]=array("field"=> "monto", "label"=> $smarty->config_vars["table_monto"]);
$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_moneda_id"]
, "table_as"=> "m", "as" => "moneda_id");
$grid_item[]=array("field"=> "monto_bs", "label"=> $smarty->config_vars["table_monto_bs"]);

$grid_item[]=array("field"=> "fecha_inicio", "label"=> $smarty->config_vars["table_fecha_inicio"]);
$grid_item[]=array("field"=> "fecha_conclusion", "label"=> $smarty->config_vars["table_fecha_conclusion"]);

$grid_item[]=array("field"=> "descripcion", "label"=> $smarty->config_vars["table_descripcion"]);

$grid_item[]=array("field" => "created_at","label"=> $smarty->config_vars["gl_table_created_at"]);
$grid_item[]=array("field" => "updated_at","label"=> $smarty->config_vars["gl_table_updated_at"]);

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