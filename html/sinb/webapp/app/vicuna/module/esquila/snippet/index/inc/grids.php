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
$grid_item[]=array("field" => "nacional_id","label"=> $smarty->config_vars["table_nacional_id"]);
$grid_item[]=array("field" => "anio","label"=> $smarty->config_vars["table_anio"]);
$grid_item[]=array("field" => "departamento","label"=> $smarty->config_vars["table_departamento"]);
$grid_item[]=array("field" => "provincia","label"=> $smarty->config_vars["table_provincia"]);
$grid_item[]=array("field" => "municipio","label"=> $smarty->config_vars["table_municipio"]);
$grid_item[]=array("field" => "arcmv","label"=> $smarty->config_vars["table_arcmv"]);
$grid_item[]=array("field" => "cmv","label"=> $smarty->config_vars["table_cmv"]);
$grid_item[]=array("field" => "numero_acta","label"=> $smarty->config_vars["table_numero_acta"]);
$grid_item[]=array("field" => "sitio_captura","label"=> $smarty->config_vars["table_sitio_captura"]);
$grid_item[]=array("field" => "numero_vicuna_sitio_captura","label"=> $smarty->config_vars["table_numero_sitio_captura"]);
$grid_item[]=array("field" => "numero_vicuna_capturadas","label"=> $smarty->config_vars["table_numero_captura"]);
$grid_item[]=array("field" => "fecha_captura","label"=> $smarty->config_vars["table_fecha_captura"]);

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