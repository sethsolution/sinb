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

/**
 * Configuración de tablas relacionales, (JOIN)
 */

$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_estado"]
,    "alias"=> "estado"
,   "campo_id"=> "itemId"
,   "relacion_id"=> "estado_id"
,   "activo"=> 1
);

/**
 * Item de las lista que se tiene desplegar
 */
$grilla_items[]=array("field" => "cantidad","label"=>"Cantidad de Precintos", "activo"=> 1);
$grilla_items[]=array("field" => "gestion","label"=>"Gestión de la Cosecha", "activo"=> 1);

$grilla_items[]=array("field"=> "nombre", "label"=>"Estado"
,   "tabla_alias"=> "estado",   "as"=>"estado_id_texto", "activo"=> 1);

$grilla_items[]=array("field" => "estado_id","label"=>"Enviado", "activo"=> 1);
$grilla_items[]=array("field" => "estado_id", "label"=>"Verificado", "as"=>"estado_id_verificado","activo"=> 1);
$grilla_items[]=array("field" => "estado_id",   "label"=>"Observado",   "as"=>"estado_id_observado",   "activo"=> 1);

$grilla_items[]=array("field"=> "fecha_emision",   "label"=>"Fecha de emisión", "activo"=> 1);
$grilla_items[]=array("field"=> "fecha_caducidad", "label"=>"Fecha de Expiración","activo"=> 1);

$grilla_items[]=array("field"=> "dateCreate", "label"=>"Fecha de creación",   "activo"=> 1);
$grilla_items[]=array("field"=> "dateUpdate", "label"=>"Fecha Actualización",   "activo"=> 1);
/**
 * Se añade el arreglo de grilla configurada a grilla
 */
$grupo = "index";
$grilla[$grupo]= $grilla_items;
$grilla_tablas_adicionales[$grupo]= $grilla_tablas;
unset($grilla_items); // siempre se borrar la variable para iniciar una nueva configuración
unset($grilla_tablas); // siempre se borrar la variable para iniciar una nueva configuración
//-------------------------------------------------------------
