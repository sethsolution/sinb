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

$field_name = "representante_legal_itemId";
$field_alias = "repLeg";
$field_activo = 1;

$grilla_tablas[] = array(
    "tabla" => "representante_legal"
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);
$field_name = "repLeg.tco_itemId";
$field_alias = "tco";
$field_activo = 1;

$grilla_tablas[] = array(
    "tabla" => "catalogo_tco"
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);
$field_name = "tco.municipio_itemId";
$field_alias = "municipio";
$field_activo = 1;




$grilla_tablas[] = array(
    "tabla" => "vrhr_territorio.municipio"
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
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
$field_name = "comunidad";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Comunidad"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "tco";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Regional"
,   "activo"=> 1
,   "tabla_alias" => "tco"
);
//-------------------------------------------------------------
$field_name = "nombre";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Municipio"
,   "activo"=> 1
,   "tabla_alias" => "municipio"
);
//-------------------------------------------------------------
$field_name = "total_carne";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Total Carne"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "total_charque";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Total Charque"
,   "activo"=> 1
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