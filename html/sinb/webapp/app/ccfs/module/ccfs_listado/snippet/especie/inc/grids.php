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
    "table" => $appVars["table"] ["cites_apendice"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "ca" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"apendice_id" //Campo de relación en la tabla principal
);
$grid_table[] = array(
    "table" => $appVars["table"] ["cites_unidad"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "cu" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"unidad_id" //Campo de relación en la tabla principal
);
$grid_table[] = array(
    "table" => $appVars["table"] ["cites_origen"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "co" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"origen_id" //Campo de relación en la tabla principal
);
/**
 * Configuración de los campos que mostraremos en la grilla
 */

$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_apendice"]
, "table_as"=> "ca", "as" => "apendice");

$grid_item[]=array("field" => "nombre_comercial","label"=> $smarty->config_vars["table_nombre_comercial"]);
$grid_item[]=array("field" => "nombre_cientifico","label"=> $smarty->config_vars["table_nombre_cientifico"]);
$grid_item[]=array("field" => "cantidad","label"=> $smarty->config_vars["table_cantidad"]);
$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_unidad"]
, "table_as"=> "cu", "as" => "unidad");
$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_origen"]
, "table_as"=> "co", "as" => "origen");
$grid_item[]=array("field" => "descripcion","label"=> $smarty->config_vars["table_descripcion"]);

$grid_item[]=array("field" => "created_at","label"=> $smarty->config_vars["gl_table_created_at"]);
$grid_item[]=array("field" => "updated_at","label"=> $smarty->config_vars["gl_table_updated_at"]);


$group = "index";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);
