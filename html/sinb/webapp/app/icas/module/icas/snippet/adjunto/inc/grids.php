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
/**
 * Configuración de los campos que mostraremos en la grilla
 */

$grid_item[]=array("field" => "descripcion","label"=> $smarty->config_vars["table_descripcion"]);

$grid_item[]=array("field"=> "attached_name","label"=> $smarty->config_vars["table_attached_name"]);
$grid_item[]=array("field" => "attached_size","label"=> $smarty->config_vars["table_attached_size"]);

$grid_item[]=array("field" => "created_at","label"=> $smarty->config_vars["gl_table_created_at"]);
$grid_item[]=array("field" => "updated_at","label"=> $smarty->config_vars["gl_table_updated_at"]);


$group = "index";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);
