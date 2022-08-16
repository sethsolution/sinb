<?php
/**
 * Configuración de los tabs a utilizarse en el snippet
 */
/**
 * Arreglos que se utilizaran en esta configuración
 */
$tabs = array();


/**
 * Realizamos la configuración de los taps para cada grupo que utilicemos
 */
//-------------------------------------------------------------

$item_tab[]=array(
    "label"=>"General"
,   "id_name"=>"general"
,   "sub_control"=>"general"
,   "active"=>"1"
,   "icon" => "flaticon-share m--font-success"
,   "new" => 1
);
//-------------------------------------------------------------
/*
$item_tab[]=array(
    "label"=>"Información Sectorial."
,   "id_name"=>"sectorial"
,   "sub_control"=>"sectorial"
,   "active"=>"0"
,   "icon" => "flaticon-folder-2 m--font-success"
,   "new" => 0
);
*/
//-------------------------------------------------------------
/*
$item_tab[]=array(
    "label"=>"Archivos"
,   "id_name"=>"archivos"
,   "sub_control"=>"archivos"
,   "active"=>"0"
,   "icon" => "flaticon-folder-2 m--font-success"
,   "new" => 0
);
*/
//-------------------------------------------------------------
/**
 * Se añade el arreglo de tabs configurada a $tabs
 */
$grupo = "index";
$tabs[$grupo]= $item_tab;
unset($item_tab); // siempre se borrar la variable para iniciar una nueva configuración

/**
 * A partir de aca puede añadir todos los grupos de tabs que sean necesarias para esta vista
 */
