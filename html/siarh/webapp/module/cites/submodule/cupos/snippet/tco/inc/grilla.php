<?php
/**
 * Configuramos todas las grillas que utilizaremos en este snippet
 */

/**
 * Arreglos que se utilizaran en esta configuración
 */
$grilla = array();
$grilla_tablas_adicionales = array();

/**
 * Configuramos las tablas adicionales para realizar un join con la tabla principal
 * estas tablas estan configuradas en el archivo db.referencia.php del submodulo
 * puede hacer un :
 *
 * print_struc($CFGm->tabla);exit;
 *
 * para ver el contenido de las tablas configuradas
 *
 * es una tabla de configuración para cada grilla
 */

/**
 * Item de las lista que se tiene desplegar
 */

//-------------------------------------------------------------
$field_name = "gestion_id";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Gestión"
,   "type_field"=>"date"//
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "cupo_id";
$field_alias = "departamento";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "departamento" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Departamento"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["cupo"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=>$field_name
        ,   "activo"=> $field_activo
        );
//-------------------------------------------------------------
$field_name = "tco_id";
$field_alias = "tco";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"TCO/PREDIO"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["c_tco"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=>$field_name
        ,   "activo"=> $field_activo
        );
//-------------------------------------------------------------
$field_name = "cupo_autorizado";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"CUPO" //
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "descripcion";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"descripcion" //
,   "activo"=> 1
);
//-------------------------------------------------------------

$grupo = "archivo";
$grilla[$grupo]= $grilla_items;
$grilla_tablas_adicionales[$grupo]= $grilla_tablas;
unset($grilla_items); // siempre se borrar la variable para iniciar una nueva configuración
unset($grilla_tablas); // siempre se borrar la variable para iniciar una nueva configuración
