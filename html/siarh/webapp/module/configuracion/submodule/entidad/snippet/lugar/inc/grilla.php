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
$field_name = "nombre";
$grilla_items[] = array(
    "campo" => $field_name // el campo de la base de datos que recupera
, "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
, "label" => "Lugar" //
, "activo" => 1
);
//-------------------------------------------------------------
$field_name = "direccion";
$grilla_items[] = array(
    "campo" => $field_name
, "field" => $field_name
, "label" => "Direccion"
, "activo" => 1
);
//-------------------------------------------------------------
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
