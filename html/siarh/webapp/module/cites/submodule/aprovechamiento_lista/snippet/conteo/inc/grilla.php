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

//3-------------------------------------------------------------
$field_name = "detalle";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=>"Detalle"
,   "activo"=> 1
);

//5-------------------------------------------------------------
$field_name = "numero_envase";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=>"Nro. de envase (bolsas u otros)" //
,   "activo"=> 1
);

//5-------------------------------------------------------------
$field_name = "numero_cortes";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=>"Nro. cortes y/o piezas" //
,   "activo"=> 1
);


//9-------------------------------------------------------------
$field_name = "peso_bruto";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=> "Peso bruto en Kg (con el envase)"
,   "activo"=> 1
);

//9-------------------------------------------------------------
$field_name = "peso_neto";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=> "Peso neto en Kg (sin el envase) "
,   "activo"=> 1
);
//9-------------------------------------------------------------
$field_name = "equivalente_metros";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=> "Equivalente en metros"
,   "activo"=> 1
);

//-------------------------------------------------------------
$grupo = "archivo";
$grilla[$grupo]= $grilla_items;
$grilla_tablas_adicionales[$grupo]= $grilla_tablas;
unset($grilla_items); // siempre se borrar la variable para iniciar una nueva configuración
unset($grilla_tablas); // siempre se borrar la variable para iniciar una nueva configuración
