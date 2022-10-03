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

$field_name = "itemId";
$field_alias = "cazador";
$field_activo = 1;

$grilla_tablas[] = array(
    "tabla" => "cazador"
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>"cazador_itemId"
,   "activo"=> $field_activo
);$grilla_tablas[] = array(
    "tabla" => "usuario_rol"
,    "alias"=> "ur"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"cazador.usuario_itemId"
,   "activo"=> $field_activo
);
$grilla_tablas[] = array(
    "tabla" => "vrhr_snir.core_usuario"
,    "alias"=> "usuario"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"ur.usuario_itemId"
,   "activo"=> $field_activo
);

$grilla_tablas[] = array(
    "tabla" => "catalogo_tco"
,    "alias"=> "tco"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"cazador.tco_itemId"
,   "activo"=> $field_activo
);

//-------------------------------------------------------------
$field_name = "itemId";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"N° Reporte"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "cantidad";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Cantidad"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "fecha_reporte";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Fecha de Reporte"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "coor_x";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Coordenada X"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "coor_y";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Coordenada Y"
,   "activo"=> 1
);
$field_name = "nombre";
$field_alias = "usuario";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre"
,   "field"=> $field_name
,   "label"=>"Nombre Cazador"
,   "as"=> $field_name
,   "tabla_alias" => $field_alias
,   "activo" => $field_activo
);
$field_name = "apellido";
$field_alias = "usuario";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "apellido"
,   "field"=> $field_name
,   "label"=>"Apellido Cazador"
,   "as"=> $field_name
,   "tabla_alias" => $field_alias
,   "activo" => $field_activo
);


$field_name = "tco";
$field_alias = "tco";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "tco"
,   "field"=> $field_name
,   "label"=>"Regional"
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