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
$field_name = "direccion_id";
$field_alias = "direccion";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Dirección"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["direccion"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=> $field_name
        ,   "activo"=> $field_activo
        );
//-------------------------------------------------------------
$field_name = "nombre";
$grilla_items[] = array(
    "campo" => $field_name // el campo de la base de datos que recupera
, "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
, "label" => "Unidad" //
, "activo" => 1
);
//-------------------------------------------------------------
$field_name = "sigla";
$grilla_items[] = array(
    "campo" => $field_name
, "field" => $field_name
, "label" => "Sigla"
, "activo" => 1
);
//-------------------------------------------------------------
$field_name = "cod1";
$grilla_items[] = array(
    "campo" => $field_name
, "field" => $field_name
, "label" => "Cod1"
, "activo" => 1
);
//-------------------------------------------------------------
$field_name = "cod2";
$grilla_items[] = array(
    "campo" => $field_name
, "field" => $field_name
, "label" => "Cod2"
, "activo" => 1
);
//-------------------------------------------------------------
$field_name = "cod3";
$grilla_items[] = array(
    "campo" => $field_name
, "field" => $field_name
, "label" => "Cod3"
, "activo" => 1
);
//-------------------------------------------------------------
$field_name = "cod4";
$grilla_items[] = array(
    "campo" => $field_name
, "field" => $field_name
, "label" => "cod4"
, "activo" => 1
);

$field_name = "principal";
$grilla_items[] = array(
    "campo" => $field_name
, "field" => $field_name
, "label" => "Pricipal"
, "activo" => 1
);

$field_name = "activo";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Activo"
,   "activo"=> 1
);
//-------------------------------------------------------------
$grupo = "archivo";
$grilla[$grupo]= $grilla_items;
$grilla_tablas_adicionales[$grupo]= $grilla_tablas;
unset($grilla_items); // siempre se borrar la variable para iniciar una nueva configuración
unset($grilla_tablas); // siempre se borrar la variable para iniciar una nueva configuración
