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
    "label"=>"Financiamiento"
,   "id_name"=>"financiamiento"
,   "sub_control"=>"financiamiento"
,   "active"=>"0"
,   "icon" => "flaticon-piggy-bank"
,   "new" => 0
);

//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"Componentes"
,   "id_name"=>"componentes"
,   "sub_control"=>"componentes"
,   "active"=>"0"
,   "icon" => "flaticon-web"
,   "new" => 0
);

//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"Metas"
,   "id_name"=>"metas"
,   "sub_control"=>"metas"
,   "active"=>"0"
,   "icon" => "flaticon-list"
,   "new" => 0
);

//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"Contrapartes"
,   "id_name"=>"contrapartes"
,   "sub_control"=>"contrapartes"
,   "active"=>"0"
,   "icon" => "flaticon-web"
,   "new" => 0
);

$item_tab[]=array(
    "label"=>"Memoria"
,   "id_name"=>"adjuntos"
,   "sub_control"=>"adjuntos"
,   "active"=>"0"
,   "icon" => "flaticon-file"
,   "new" => 0
);

$item_tab[]=array(
    "label"=>"Referencias"
,   "id_name"=>"referencias"
,   "sub_control"=>"referencias"
,   "active"=>"0"
,   "icon" => "flaticon-user"
,   "new" => 0
);

/**
 * Se añade el arreglo de tabs configurada a $tabs
 */
$grupo = "tab_proyectos";
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