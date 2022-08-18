<?PHP
/**
 * Configuramos todas las grillas que utilizaremos en este snippet
 */

/**
 * Arreglos que se utilizaran en esta configuración
 */
$grid = array();
$grid_table_join = array();


/**
 * Configuramos las tablas adicionales para realizar un join con la tabla principal
 * estas tablas estan configuradas en el archivo db.referencia.php del submodulo
 * puede hacer un :
 *
 * print_struc($appVars["table"] );exit;
 *
 * para ver el contenido de las tablas configuradas
 *
 * es una tabla de configuración para cada grilla
 */

/**
 * Item de las lista que se tiene desplegar
 */
//-------------------------------------------------------------
$field_name = "ip";
$grid_item[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"IP"
,   "active"=> 1
);
//-------------------------------------------------------------
$field_name = "proveedor_id";
$field_alias = "proveedor";
$field_activo = 1;
$grid_item[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Proveedor"
,   "as" => $field_name
,   "table_as"=> $field_alias
,   "active"=> $field_activo
);
$grid_table[] = array(
    "table" => $appVars["table"] ["c_proveedor"]
,    "alias"=> $field_alias
,   "field_id"=>"itemId"
,   "relationship_id"=> $field_name
,   "active"=> $field_activo
);
//-------------------------------------------------------------
$field_name = "lugar_id";
$field_alias = "lugar";
$field_activo = 1;
$grid_item[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Lugar"
,   "as" => $field_name
,   "table_as"=> $field_alias
,   "active"=> $field_activo
);
$grid_table[] = array(
    "table" => $appVars["table"] ["c_lugar"]
,    "alias"=> $field_alias
,   "field_id"=>"itemId"
,   "relationship_id"=> $field_name
,   "active"=> $field_activo
);
//-------------------------------------------------------------
$field_name = "active";
$grid_item[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"active"
,   "active"=> 1
);

//-------------------------------------------------------------

/**
 * Se añade el arreglo de grilla configurada a grilla
 */
$group = "item";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item); // siempre se borrar la variable para iniciar una nueva configuración
unset($grid_table); // siempre se borrar la variable para iniciar una nueva configuración
/**
 * A partir de aca puede añadir todas las grillas que sean necesarias para esta vista
 */
/*
$grid_item = array();

$field_name = "active";
$grid_item[]=array(
    "campo" => $field_name
,    "field"=> $field_name
,   "label"=>"Ac"
,   "type_field"=>"text"
,   "as" => ""
);

$field_name = "nombres";
$grid_item[]=array(
    "campo" => $field_name
,   "field" => "$field_name"
,   "label"=>"Nombres"
,   "type_field"=>"text"
,   "as" => ""
);
$grid["otra_grilla"]= $grid_item;
*/