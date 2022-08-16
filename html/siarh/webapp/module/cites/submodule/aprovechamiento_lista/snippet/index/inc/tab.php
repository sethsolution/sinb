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
    "label"=>"INFORMACIÓN GENERAL"
,   "id_name"=>"general"
,   "sub_control"=>"general"
,   "active"=>"1"
,   "icon" => "fa fa-layer-group"
,   "new" => 1
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"PRECINTOS"
,   "id_name"=>"utilizado"
,   "sub_control"=>"utilizado"
,   "active"=>"0"
,   "icon" => "fa fa-layer-group"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"CORTES"
,   "id_name"=>"conteo"
,   "sub_control"=>"conteo"
,   "active"=>"0"
,   "icon" => "fa fa-layer-group"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"DOCUMENTACIÓN"
,   "id_name"=>"requisitos"
,   "sub_control"=>"requisitos"
,   "active"=>"0"
,   "icon" => "fa fa-layer-grouP"
,   "new" => 0
);

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