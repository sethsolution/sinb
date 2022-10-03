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


$field_name = "municipio_itemId";
$field_alias = "m";
$field_activo = 1;

$grilla_tablas[] = array(
    "tabla" => "vrhr_territorio.municipio"
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);
$field_alias = "prov";
$field_activo = 1;
$grilla_tablas[] = array(
    "tabla" => "vrhr_territorio.provincia"
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>"m.provinciaId"
,   "activo"=> $field_activo
);
$field_alias = "depto";
$field_activo = 1;
$grilla_tablas[] = array(
    "tabla" => "vrhr_territorio.departamento"
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>"prov.departamentoId"
,   "activo"=> $field_activo
);

//-------------------------------------------------------------
$field_name = "tco";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Regional"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "nombre_municipio";
$field_alias = "m";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre"
,   "field"=> $field_name
,   "label"=>"Municipio"
,   "as"=> $field_name
,   "tabla_alias" => $field_alias
,   "activo" => $field_activo
);
$field_name = "nombre_provincia";
$field_alias = "prov";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre"
,   "field"=> $field_name
,   "label"=>"Provincia"
,   "as"=> $field_name
,   "tabla_alias" => $field_alias
,   "activo" => $field_activo
);

$field_name = "nombre_departamento";
$field_alias = "depto";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre"
,   "field"=> $field_name
,   "label"=>"Departamento"
,   "as"=> $field_name
,   "tabla_alias" => $field_alias
,   "activo" => $field_activo
);


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