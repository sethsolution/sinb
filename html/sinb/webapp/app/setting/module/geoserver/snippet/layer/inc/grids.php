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
$grid_item[]=array("field" => "title","label"=> $smarty->config_vars["tableTitle"]);
$grid_item[]=array("field"=> "abstract","label"=> $smarty->config_vars["tableAbstract"]);
$grid_item[]=array("field"=> "format","label"=> $smarty->config_vars["tableFormat"]);
$grid_item[]=array("field"=> "active","label"=> $smarty->config_vars["tableStatus"]);

$group = "index";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);
