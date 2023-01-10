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
    "table" => $appVars["table"] ["ilicito_categoria"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "c" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"categoria_id" //Campo de relación en la tabla principal
);

$grid_table[] = array(
    "table" => $appVars["table"] ["ilicito_estado_salud"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "es" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"estado_salud_id" //Campo de relación en la tabla principal
);

/**
 * Configuración de los campos que mostraremos en la grilla
 */

$grid_item[]=array("field" => "gestion","label"=> $smarty->config_vars["table_gestion"]);
$grid_item[]=array("field" => "mes","label"=> $smarty->config_vars["table_mes"]);
$grid_item[]=array("field" => "departamento","label"=> $smarty->config_vars["table_departamento"]);
$grid_item[]=array("field" => "entregado","label"=> $smarty->config_vars["table_entregado"]);
$grid_item[]=array("field" => "procedencia","label"=> $smarty->config_vars["table_procedencia"]);

$grid_item[]=array("field" => "clase","label"=> $smarty->config_vars["table_clase"]);
$grid_item[]=array("field" => "nombre_comun","label"=> $smarty->config_vars["table_nombre_comun"]);
$grid_item[]=array("field" => "nombre_cientifico","label"=> $smarty->config_vars["table_nombre_cientifico"]);
$grid_item[]=array("field" => "cantidad","label"=> $smarty->config_vars["table_cantidad"]);

$grid_item[]=array("field" => "destino","label"=> $smarty->config_vars["table_destino"]);

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_categoria"]
, "table_as"=> "c", "as" => "categoria_id");

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_estado_salud"]
, "table_as"=> "es", "as" => "estado_salud_id");

$grid_item[]=array("field" => "fecha","label"=> $smarty->config_vars["table_fecha"]);
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