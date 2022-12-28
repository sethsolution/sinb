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
,   "icon" => "flaticon-home"
,   "new" => 1
);

//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"Inf. nutricional"
,   "id_name"=>"infonutricional"
,   "sub_control"=>"infonutricional"
,   "active"=>"0"
,   "icon" => "flaticon-medical"
,   "new" => 0
);

$item_tab[]=array(
    "label"=>"Ecotipos"
,   "id_name"=>"ecotipos"
,   "sub_control"=>"ecotipos"
,   "active"=>"0"
,   "icon" => "flaticon-list"
,   "new" => 0
);

$item_tab[]=array(
    "label"=>"Descriptor"
,   "id_name"=>"descriptor"
,   "sub_control"=>"descriptor"
,   "active"=>"0"
,   "icon" => "fa fa-tree"
,   "new" => 0
);

$item_tab[]=array(
    "label"=>"Proyectos"
,   "id_name"=>"proyectos"
,   "sub_control"=>"proyectos"
,   "active"=>"0"
,   "icon" => "flaticon-shapes"
,   "new" => 0
);

$item_tab[]=array(
    "label"=>"Inf. adicional"
,   "id_name"=>"infoadicional"
,   "sub_control"=>"infoadicional"
,   "active"=>"0"
,   "icon" => "flaticon-shapes"
,   "new" => 0
);

$item_tab[]=array(
    "label"=>"Adjuntos"
,   "id_name"=>"adjuntos"
,   "sub_control"=>"adjuntos"
,   "active"=>"0"
,   "icon" => "flaticon-tool-1"
,   "new" => 0
);

/**
 * Se añade el arreglo de tabs configurada a $tabs
 */
$grupo = "tab_especies";
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