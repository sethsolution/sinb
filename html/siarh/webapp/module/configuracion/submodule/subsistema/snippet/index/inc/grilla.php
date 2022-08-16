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
$field_name = "titulo";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Nombre"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "carpeta";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Carpeta"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "orden";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Orden"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "descripcion";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Descripción"
,   "activo"=> 1
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
/**
 * Se añade el arreglo de grilla configurada a grilla
 */
$grupo = "item";
$grilla[$grupo]= $grilla_items;
$grilla_tablas_adicionales[$grupo]= $grilla_tablas;
unset($grilla_items); // siempre se borrar la variable para iniciar una nueva configuración
unset($grilla_tablas); // siempre se borrar la variable para iniciar una nueva configuración
/**
 * A partir de aca puede añadir todas las grillas que sean necesarias para esta vista
 */
/*
$grilla_items = array();

$field_name = "activo";
$grilla_items[]=array(
    "campo" => $field_name
,    "field"=> $field_name
,   "label"=>"Ac"
,   "type_field"=>"text"
,   "as" => ""
);

$field_name = "nombres";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => "$field_name"
,   "label"=>"Nombres"
,   "type_field"=>"text"
,   "as" => ""
);
$grilla["otra_grilla"]= $grilla_items;
*/