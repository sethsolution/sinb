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
    "table" => $appVars["table"] ["icas_area"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "a" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"area_id" //Campo de relación en la tabla principal
);

$grid_table[] = array(
    "table" => $appVars["table"] ["icas_estado"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "e" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"estado_id" //Campo de relación en la tabla principal
);

/**
 * Configuración de los campos que mostraremos en la grilla
 */

$grid_item[]=array("field"=> "codigo", "label"=> $smarty->config_vars["table_codigo"]);
$grid_item[]=array("field" => "nombre","label"=> $smarty->config_vars["table_titulo"]);

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_area"]
, "table_as"=> "a", "as" => "area_id");

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_estado"]
, "table_as"=> "e", "as" => "estado_id");

$grid_item[]=array("field"=> "departamento", "label"=> $smarty->config_vars["table_departamento"]);
$grid_item[]=array("field"=> "fecha_conclusion", "label"=> $smarty->config_vars["table_fecha_conclusion"]);
$grid_item[]=array("field"=> "fecha_inicio", "label"=> $smarty->config_vars["table_fecha_inicio"]);
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