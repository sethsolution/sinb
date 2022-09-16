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
 * Configuración de tablas relacionales, (JOIN)
 */
$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_especie"]
,    "alias"=> "especie_comun"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"especie_id"
,   "activo"=> 1
);

$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_especie"]
,    "alias"=> "especie"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"especie_id"
,   "activo"=> 1
);

$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_tipo_unidad"]
,    "alias"=> "unidad"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"unidad_id"
,   "activo"=> 1
);
/**
 * Item de las lista que se tiene desplegar
 */

$grilla_items[]=array("field"=> "nombre","label"=>"Nombre comun"
,   "tabla_alias"=> "especie_comun", "as" => "especie_id_comun", "activo"=> 1);

$grilla_items[]=array("field"=> "especie_id",   "label"=>"id Especie", "as"=>"especie_id_id", "activo"=> 1);
$grilla_items[]=array("field"=> "especie_nombre", "label"=>"Nombre Especie", "activo"=> 1);

$grilla_items[]=array("field"=> "nombre","label"=>"7/8 Nombre Científico y Nombre Común"
,   "tabla_alias"=> "especie", "as" => "especie_id", "activo"=> 1);

$grilla_items[]=array("field"=> "descripcion", "label"=>"9. Descripción de los especímenes", "activo"=> 1);
$grilla_items[]=array("field"=> "cantidad", "label"=>"10. Cantidad", "activo"=> 1);

$grilla_items[]=array("field"=> "nombre","label"=>"10. unidad"
,   "tabla_alias"=> "unidad", "as" => "unidad_id", "activo"=> 1);

$grupo = "archivo";
$grilla[$grupo]= $grilla_items;
$grilla_tablas_adicionales[$grupo]= $grilla_tablas;
unset($grilla_items); // siempre se borrar la variable para iniciar una nueva configuración
unset($grilla_tablas); // siempre se borrar la variable para iniciar una nueva configuración
