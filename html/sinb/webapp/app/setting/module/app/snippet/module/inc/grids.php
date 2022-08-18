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
    "table" => $appVars["table"] ["app_group"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "g" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"app_group_id" //Campo de relación en la tabla principal
);
/**
 * Configuración de los campos que mostraremos en la grilla
 */
$grid_item[]=array(
   "field" => "name" // el campo de la base de datos relacional
,   "label"=> $smarty->config_vars["tableGroupname"]
,   "table_as"=> "g"
,   "as" => "groupname"
);
$grid_item[]=array("field" => "name","label"=> $smarty->config_vars["tableName"]);
$grid_item[]=array("field" => "id","label"=> $smarty->config_vars["tableId"]);
$grid_item[]=array("field"=> "order","label"=> $smarty->config_vars["tableOrder"]);
$grid_item[]=array("field"=> "class","label"=> $smarty->config_vars["tableClass"]);
$grid_item[]=array("field"=> "target","label"=> $smarty->config_vars["tableTarget"]);
$grid_item[]=array("field"=> "type","label"=> $smarty->config_vars["tableType"]);
$grid_item[]=array("field"=> "folder","label"=> $smarty->config_vars["tableFolder"]);
$grid_item[]=array("field"=> "url","label"=>"Url");
$grid_item[]=array("field"=> "description","label"=> $smarty->config_vars["tableDescription"]);
$grid_item[]=array("field"=> "active","label"=> $smarty->config_vars["tableStatus"]);

$group = "module";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);
