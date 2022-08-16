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
$field_name = "parent";
$field_alias = "pa";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Grupo"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["submodulo"]
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);
//-------------------------------------------------------------
$field_name = "nombre";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Nombre"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "itemId";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"ID"
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
$field_name = "class";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Icono"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "tipo";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Tipo"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "modulo_id_tipo";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Módulo"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "submodulo_id";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Submódulo"
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
$field_name = "url";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Url"
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

$field_name = "target";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Nueva Ventana"
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
$grupo = "submodulo";
$grilla[$grupo]= $grilla_items;
$grilla_tablas_adicionales[$grupo]= $grilla_tablas;
unset($grilla_items); // siempre se borrar la variable para iniciar una nueva configuración
unset($grilla_tablas); // siempre se borrar la variable para iniciar una nueva configuración
