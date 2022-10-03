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

$field_name = "rol_itemId";
$field_alias = "r";
$field_activo = 1;

$grilla_tablas[] = array(
    "tabla" => "catalogo_rol"
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);

$field_name = "usuario_itemId";
$field_alias = "us";
$field_activo = 1;

$grilla_tablas[] = array(
    "tabla" => "vrhr_snir.core_usuario"
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);


//-------------------------------------------------------------
$field_name = "usuario";
$field_alias = "us";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "usuario"
,   "field"=> $field_name
,   "label"=>"Usuario"
,   "as"=> $field_name
,   "tabla_alias" => $field_alias
,   "activo" => $field_activo
);
//-------------------------------------------------------------
$field_name = "nombre";
$field_alias = "us";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre"
,   "field"=> $field_name
,   "label"=>"Nombre"
,   "as"=> $field_name
,   "tabla_alias" => $field_alias
,   "activo" => $field_activo
);
//-------------------------------------------------------------
$field_name = "apellido";
$field_alias = "us";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "apellido"
,   "field"=> $field_name
,   "label"=>"Apellido"
,   "as"=> $field_name
,   "tabla_alias" => $field_alias
,   "activo" => $field_activo
);
//-------------------------------------------------------------
$field_name = "telefono";
$field_alias = "us";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "telefono"
,   "field"=> $field_name
,   "label"=>"Telefono"
,   "as"=> $field_name
,   "tabla_alias" => $field_alias
,   "activo" => $field_activo
);
//-------------------------------------------------------------
$field_name = "email";
$field_alias = "us";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "email"
,   "field"=> $field_name
,   "label"=>"Email"
,   "as"=> $field_name
,   "tabla_alias" => $field_alias
,   "activo" => $field_activo
);
//-------------------------------------------------------------
$field_name = "nombre_rol";
$field_alias = "r";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre_rol"
,   "field"=> $field_name
,   "label"=>"Rol"
,   "as"=> $field_name
,   "tabla_alias" => $field_alias
,   "activo" => $field_activo
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