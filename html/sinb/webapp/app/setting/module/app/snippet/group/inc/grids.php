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
$grid_item[]=array("field" => "name","label"=> $smarty->config_vars["tableName"]);
$grid_item[]=array("field" => "id","label"=> $smarty->config_vars["tableId"]);
$grid_item[]=array("field"=> "order","label"=> $smarty->config_vars["tableOrder"]);
$grid_item[]=array("field"=> "class","label"=> $smarty->config_vars["tableClass"]);
$grid_item[]=array("field"=> "description","label"=> $smarty->config_vars["tableDescription"]);
$grid_item[]=array("field"=> "active","label"=> $smarty->config_vars["tableStatus"]);

$group = "index";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);
