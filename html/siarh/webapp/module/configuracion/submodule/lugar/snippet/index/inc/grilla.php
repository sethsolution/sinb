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
 *
 *
 */
//-------------------------------------------------------------
$field_name = "entidad_id";
$field_alias = "ent";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Entidad"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["entidad"]
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);
//-------------------------------------------------------------
$field_name = "nombre";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Nombre"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "direccion";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Direccion"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "latitud";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Latitud"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "longitud";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"longitud"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "telefonos";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Telefonos"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "adjunto_tipo";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Tipo"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "adjunto_nombre";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Archivo"
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
/*

//-------------------------------------------------------------
$field_name = "activo";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Activo"
,   "activo"=> 1
);
*/
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