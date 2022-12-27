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
    "table" => $appVars["table"] ["gestion"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "g" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"gestion_id" //Campo de relación en la tabla principal
);
$grid_table[] = array(
    "table" => $appVars["table"] ["ccfs_especie_tipo"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "cet" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"especie_tipo_id" //Campo de relación en la tabla principal
);
/**
 * Configuración de los campos que mostraremos en la grilla
 */

$grid_item[]=array( "field" => "id", "label"=> $smarty->config_vars["table_gestion"]
, "table_as"=> "g", "as" => "gestion_id");
$grid_item[]=array( "field" => "nombre", "label"=> $smarty->config_vars["table_especie_tipo"]
, "table_as"=> "cet", "as" => "especie_tipo");

$grid_item[]=array("field" => "especie","label"=> $smarty->config_vars["table_especie"]);
$grid_item[]=array("field" => "numero_animales_albergar","label"=> $smarty->config_vars["table_numero_animales_albergar"]);
$grid_item[]=array("field" => "numero_animales_gestion","label"=> $smarty->config_vars["table_numero_animales_gestion"]);
$grid_item[]=array("field" => "nacimientos","label"=> $smarty->config_vars["table_nacimientos"]);
$grid_item[]=array("field" => "ingreso_recepcion","label"=> $smarty->config_vars["table_ingreso_recepcion"]);
$grid_item[]=array("field" => "transferencia_de_ccfs","label"=> $smarty->config_vars["table_transferencia_de_ccfs"]);
$grid_item[]=array("field" => "decesos","label"=> $smarty->config_vars["table_decesos"]);
$grid_item[]=array("field" => "transferencia_a_ccfs","label"=> $smarty->config_vars["table_transferencia_a_ccfs"]);
$grid_item[]=array("field" => "total_albergados","label"=> $smarty->config_vars["table_total_albergados"]);
$grid_item[]=array("field" => "descripcion","label"=> $smarty->config_vars["table_descripcion"]);

$grid_item[]=array("field" => "created_at","label"=> $smarty->config_vars["gl_table_created_at"]);
$grid_item[]=array("field" => "updated_at","label"=> $smarty->config_vars["gl_table_updated_at"]);


$group = "index";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item);
unset($grid_table);
