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
    "table" => $appVars["table"] ["app_module"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "m" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"app_module_id" //Campo de relación en la tabla principal
);
$grid_table[] = array(
    "table" => $appVars["table"] ["app_group"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "g" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"m.app_group_id" //Campo de relación en la tabla principal
);
$grid_table[] = array(
    "table" => $appVars["table"] ["app"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "a" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"m.app_id" //Campo de relación en la tabla principal
);

/**
 * Configuración de los campos que mostraremos en la grilla
 */
//$grid_item[]=array("field" => "anio","label"=> $smarty->config_vars["field_anio"]);
$grid_item[]=array("field" => "name", "label"=> $smarty->config_vars["field_app"]
,"table_as"=> "a", "as" => "app");

$grid_item[]=array("field" => "name", "label"=> $smarty->config_vars["field_group"]
,"table_as"=> "g", "as" => "group");

$grid_item[]=array("field" => "name", "label"=> $smarty->config_vars["field_module"]
,"table_as"=> "m", "as" => "module");



$grid_item[]=array("field" => "type", "label"=> $smarty->config_vars["field_type"]
,"table_as"=> "m", "as" => "type");

$grid_item[]=array("field" => "add","label"=> $smarty->config_vars["field_add"]);
$grid_item[]=array("field" => "edit","label"=> $smarty->config_vars["field_edit"]);
$grid_item[]=array("field" => "delete","label"=> $smarty->config_vars["field_delete"]);
$grid_item[]=array("field" => "active", "label"=> $smarty->config_vars["field_module_active"]
,"table_as"=> "m", "as" => "active");
$grid_item[]=array("field" => "created_at","label"=> $smarty->config_vars["gl_table_created_at"]);
$grid_item[]=array("field" => "updated_at","label"=> $smarty->config_vars["gl_table_updated_at"]);


$group = "index";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);


/**
 * Configuración de tablas relacionales, (JOIN)
 */


$grid_table[] = array(
    "table" => $appVars["table"] ["app_group"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "g" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"app_group_id" //Campo de relación en la tabla principal
);
$grid_table[] = array(
    "table" => $appVars["table"] ["app"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "a" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"app_id" //Campo de relación en la tabla principal
);

/**
 * Configuración de los campos que mostraremos en la grilla
 */
//$grid_item[]=array("field" => "anio","label"=> $smarty->config_vars["field_anio"]);
$grid_item[]=array("field" => "name", "label"=> $smarty->config_vars["field_app"]
,"table_as"=> "a", "as" => "app");

$grid_item[]=array("field" => "name", "label"=> $smarty->config_vars["field_group"]
,"table_as"=> "g", "as" => "group");
$grid_item[]=array("field" => "id","label"=> $smarty->config_vars["field_type"]);
$grid_item[]=array("field" => "name","label"=> $smarty->config_vars["field_module"]);
$grid_item[]=array("field" => "type","label"=> $smarty->config_vars["field_type"]);


$group = "form";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);
