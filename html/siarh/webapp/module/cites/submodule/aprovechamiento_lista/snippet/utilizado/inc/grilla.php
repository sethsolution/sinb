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
$field_name = "anio";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=>"Gestión de aprovechamiento"
,   "activo"=> 1
);

//5-------------------------------------------------------------
$field_name = "precinto_inicial";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=>"Nro. de Precinto inicial utilizado" //
,   "activo"=> 1
);

//5-------------------------------------------------------------
$field_name = "precinto_final";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=>"Nro. de Precinto final utilizado" //
,   "activo"=> 1
);


//9-------------------------------------------------------------
$field_name = "precinto_total_utilizados";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=> "Total precintos utilizados "
,   "activo"=> 1
);

//9-------------------------------------------------------------
$field_name = "precinto_total_noutilizados";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=> "Total precintos NO utilizados "
,   "activo"=> 1
);

//-------------------------------------------------------------

$field_name = "codigo_precintos_baja";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Codigo alfa-numero de los precintos dados de BAJA" //
,   "activo"=> 1
);

//-------------------------------------------------------------
$grupo = "archivo";
$grilla[$grupo]= $grilla_items;
$grilla_tablas_adicionales[$grupo]= $grilla_tablas;
unset($grilla_items); // siempre se borrar la variable para iniciar una nueva configuración
unset($grilla_tablas); // siempre se borrar la variable para iniciar una nueva configuración
