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
    "table" => $appVars["table"] ["estado"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "e" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"estado_id" //Campo de relación en la tabla principal
);
/**
 * Configuración de los campos que mostraremos en la grilla
 */
$grid_item[]=array("field"=> "cod_proy", "label"=> $smarty->config_vars["table_cod_proy"]);
$grid_item[]=array("field" => "nombre","label"=> $smarty->config_vars["table_nombre"]);
$grid_item[]=array("field" => "nombre", "label"=>  $smarty->config_vars["table_estado"]
,   "table_as"=> "e",   "as" => "estado");

//$grid_item[]=array("field" => "gd_categoria_id","label"=> $smarty->config_vars["table_catagory"]);
$grid_item[]=array("field" => "sisin","label"=> $smarty->config_vars["table_sisin"]);
$grid_item[]=array("field" => "departamento","label"=> $smarty->config_vars["table_departamento"]);
$grid_item[]=array("field" => "municipio","label"=> $smarty->config_vars["table_municipio"]);

$grid_item[]=array("field" => "location_longitude_decimal","label"=> $smarty->config_vars["table_location_longitude_decimal"]);
$grid_item[]=array("field" => "location_latitude_decimal","label"=> $smarty->config_vars["table_location_latitude_decimal"]);







$group = "index";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);
