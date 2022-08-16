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
    "label"=>"Registro de un nuevo usuario"
,   "id_name"=>"general"
,   "sub_control"=>"general"
,   "active"=>"1"
//,    "disabled"=>"0"
,   "icon" => "flaticon-users m--font-success"
,   "new" => 0
);
$item_tab[]=array(
    "label"=>"Cargado de requisitos"
,   "id_name"=>"requisitos"
,   "sub_control"=>"requisitos"
,   "active"=>"0"
//,   "disabled"=>"0"
,   "icon" => "fa fa-archive"
,   "new" => 0
);

/*
$item_tab[]=array(
    "label"=>"Tipo Marca"
,   "id_name"=>"tipomarca"
,   "sub_control"=>"tipomarca"
,   "active"=>"0"
,   "icon" => "flaticon-layers m--font-success"
,   "new" => 0
);


$item_tab[]=array(
    "label"=>"Tipo Proposito"
,   "id_name"=>"tipoproposito"
,   "sub_control"=>"tipoproposito"
,   "active"=>"0"
,   "icon" => "flaticon-layers m--font-success"
,   "new" => 0
);
*/
/**/
//-------------------------------------------------------------
/**
 * Se añade el arreglo de tabs configurada a $tabs
 */
$grupo = "index";
$tabs[$grupo]= $item_tab;
unset($item_tab); // siempre se borrar la variable para iniciar una nueva configuración

/* /
print_struc($tabs);
exit;
/**/

/**
 * A partir de aca puede añadir todos los grupos de tabs que sean necesarias para esta vista
 */
