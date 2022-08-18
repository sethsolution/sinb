<?PHP
/**
 * Configuramos todas las grillas que utilizaremos en este snippet
 */
$grid = array();
$grid_table_join = array();

\Core\Core::setLenguage("tableIndex"); //cargamos idioma


$grid_item[]=array("field"=> "name", "label"=> $smarty->config_vars["table_name"]);
$grid_item[]=array("field"=> "last_name","label"=> $smarty->config_vars["table_name_last"]);
$grid_item[]=array("field"=> "username","label"=> $smarty->config_vars["table_usernme"]);
$grid_item[]=array("field"=> "mobile","label"=> $smarty->config_vars["table_mobile"]);
$grid_item[]=array("field"=> "type","label"=> $smarty->config_vars["table_type"]);
$grid_item[]=array("field"=> "active", "label"=> $smarty->config_vars["table_status"]);
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
