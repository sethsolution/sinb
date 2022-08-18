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

/*
//-------------------------------------------------------------
$field_name = "nombres";
$grid_item[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Nombres" //
,   "active"=> 1
);
//-------------------------------------------------------------
$field_name = "apellido_paterno";
$grid_item[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=> "Apellido Paterno"
,   "active"=> 1
);
//-------------------------------------------------------------
$field_name = "ci_exp";
$field_alias = "depa";
$field_activo = 1;
$grid_item[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Expedido"
,   "as" => $field_name
,   "table_as"=> $field_alias
,   "active"=> $field_activo
);
        $grid_table[] = array(
            "table" => $appVars["table"] ["o_departamento"]
        ,    "alias"=> $field_alias
        ,   "field_id"=>"itemId"
        ,   "relationship_id"=> $field_name
        ,   "active"=> $field_activo
        );
//-------------------------------------------------------------
$group = "nombre_funcionalidad";
$grid[$group]= $grid_item;
$grid_table_join[$group]= $grid_table;
unset($grid_item); // siempre se borrar la variable para iniciar una nueva configuración
unset($grid_table); // siempre se borrar la variable para iniciar una nueva configuración
*/