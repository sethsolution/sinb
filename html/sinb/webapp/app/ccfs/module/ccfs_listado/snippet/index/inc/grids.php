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
    "table" => $appVars["table"] ["ccfs_categoria"] // Nombre de la tabla con la que hara la relación
,    "alias"=> "cc" //Alias de la tabla para el join
,   "field_id"=>"id" //Id de la tabla que hara la relación
,   "relationship_id"=>"categoria_id" //Campo de relación en la tabla principal
);

/**
 * Configuración de los campos que mostraremos en la grilla
 */
//[0]
$grid_item[]=array("field" => "nombre","label"=> $smarty->config_vars["table_nombre"]);
//[1]
$grid_item[]=array("field" => "codigo","label"=> $smarty->config_vars["table_codigo"]);
//[2]
$grid_item[]=array(
    "field" => "nombre"
,   "label"=> $smarty->config_vars["table_ccfs_categoria"]
,   "table_as"=> "cc"
,   "as" => "categoria"
);
//[3]
$grid_item[]=array("field" => "condicion","label"=> $smarty->config_vars["table_condicion"]);
//[4]
$grid_item[]=array("field" => "licencia_funcionamiento","label"=> $smarty->config_vars["table_licencia_funcionamiento"]);
//[5]
$grid_item[]=array("field" => "formato","label"=> $smarty->config_vars["table_formato"]);;
//[6]
$grid_item[]=array("field" => "fecha_emision","label"=> $smarty->config_vars["table_fecha_emision"]);;
//[7]
$grid_item[]=array("field" => "fecha_conclusion","label"=> $smarty->config_vars["table_fecha_conclusion"]);
//[8]
$grid_item[]=array("field" => "superficie","label"=> $smarty->config_vars["table_superficie"]);

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