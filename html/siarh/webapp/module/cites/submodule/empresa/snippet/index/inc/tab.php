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

$item_tab[]=array(
    "label"=>"Requisitos"
,   "id_name"=>"requisitos"
,   "sub_control"=>"requisitos"
,   "active"=>"0"
,   "icon" => "fa fa-archive"
,   "new" => 0
);

$item_tab[]=array(
    "label"=>"Registro de Depósito"
,   "id_name"=>"pagos"
,   "sub_control"=>"pagos"
,   "active"=>"0"
,   "icon" => "flaticon-layers m--font-success"
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
/*
$item_tab = array();
$item_tab[]=array(
    "label"=>"General"
,   "id_name"=>"general"
,   "sub_control"=>"general"
,   "active"=>"1"
,   "icon" => "flaticon-share"
,   "new" => 1
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"Codice"
,   "id_name"=>"codice"
,   "sub_control"=>"codice"
,   "active"=>"0"
,   "icon" => "fa fa-address-book"
,   "new" => 0
);
$grupo = "otro_grupo";
$tabs[$grupo]= $item_tab;
unset($item_tab);
*/