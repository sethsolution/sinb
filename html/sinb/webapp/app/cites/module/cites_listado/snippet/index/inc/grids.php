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
    "table" => $appVars["table"] ["cites_tipo_documento"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "ctp" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"tipo_documento_id" //Campo de relación en la tabla principal
);

$grid_table[] = array(
    "table" => $appVars["table"] ["cites_proposito"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "cp" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"proposito_id" //Campo de relación en la tabla principal
);

/**
 * Configuración de los campos que mostraremos en la grilla
 */
//[0]
$grid_item[]=array("field" => "fecha","label"=> $smarty->config_vars["table_fecha"]);
//[1]
$grid_item[]=array(
    "field" => "nombre"
,   "label"=> $smarty->config_vars["table_cites_tipo_documento"]
,   "table_as"=> "ctp"
,   "as" => "tipo_documento"
);
//[2]
$grid_item[]=array("field" => "numero_cites","label"=> $smarty->config_vars["table_numero_cites"]);
//[3]
$grid_item[]=array("field" => "exportador","label"=> $smarty->config_vars["table_exportador"]);
//[4]
$grid_item[]=array("field" => "destinatario","label"=> $smarty->config_vars["table_destinatario"]);
//[5]
$grid_item[]=array(
    "field" => "nombre"
,   "label"=> $smarty->config_vars["table_proposito"]
,   "table_as"=> "cp"
,   "as" => "proposito"
);
//[6]
$grid_item[]=array("field" => "fecha_valido","label"=> $smarty->config_vars["table_fecha_valido"]);;
//[7]
$grid_item[]=array("field" => "observacion","label"=> $smarty->config_vars["table_observacion"]);

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
/*/
print_struc($grid_table_join);
print_struc($grid);
exit;
/**/