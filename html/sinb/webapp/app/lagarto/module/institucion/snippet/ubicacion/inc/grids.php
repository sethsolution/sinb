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
//
$grid_table[] = array(
    "table" => $appVars["table"] ["departamento"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "dep" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"departamento_id" //Campo de relación en la tabla principal
);
$grid_table[] = array(
    "table" => $appVars["table"] ["municipio"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "mun" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"municipio_id" //Campo de relación en la tabla principal
);
/**
 * Configuración de los campos que mostraremos en la grilla
 */

$grid_item[]=array( "field" => "name", "label"=> $smarty->config_vars["table_departamento"]
, "table_as"=> "dep", "as" => "departamento_id");

$grid_item[]=array("field" => "provincia","label"=> $smarty->config_vars["table_provincia"]);

$grid_item[]=array( "field" => "name", "label"=> $smarty->config_vars["table_municipio"]
, "table_as"=> "mun", "as" => "municipio_id");



$grid_item[]=array("field" => "comunidad","label"=> $smarty->config_vars["table_comunidad"]);
$grid_item[]=array("field" => "distrito","label"=> $smarty->config_vars["table_distrito"]);
$grid_item[]=array("field" => "participacion","label"=> $smarty->config_vars["table_participacion"]);

$grid_item[]=array("field" => "main","label"=> $smarty->config_vars["table_main"]);

$grid_item[]=array("field" => "created_at","label"=> $smarty->config_vars["gl_table_created_at"]);
$grid_item[]=array("field" => "updated_at","label"=> $smarty->config_vars["gl_table_updated_at"]);


$group = "index";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);
