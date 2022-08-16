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
/*
$item_tab[]=array(
    "label"=>"Tipo Actividad"
,   "id_name"=>"tipoactividad"
,   "sub_control"=>"tipoactividad"
,   "active"=>"0"
,   "icon" => "flaticon-layers m--font-success"
,   "new" => 0
);
*/
$item_tab[]=array(
    "label"=>"Tipo Documento"
,   "id_name"=>"tipodocumento"
,   "sub_control"=>"tipodocumento"
,   "active"=>"0"
,   "icon" => "flaticon-layers m--font-success"
,   "new" => 0
);


$item_tab[]=array(
    "label"=>"Tipo unidad"
,   "id_name"=>"tipounidad"
,   "sub_control"=>"tipounidad"
,   "active"=>"0"
,   "icon" => "flaticon-layers m--font-success"
,   "new" => 0
);

$item_tab[]=array(
    "label"=>"Estados"
,   "id_name"=>"tipoestado"
,   "sub_control"=>"tipoestado"
,   "active"=>"0"
,   "icon" => "flaticon-layers m--font-success"
,   "new" => 0
);
/**/

$item_tab[]=array(
    "label"=>"País"
,   "id_name"=>"pais"
,   "sub_control"=>"pais"
,   "active"=>"0"
,   "icon" => "flaticon-layers m--font-success"
,   "new" => 0
);

$item_tab[]=array(
    "label"=>"Especies"
,   "id_name"=>"tipoespecie"
,   "sub_control"=>"tipoespecie"
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

/* /
print_struc($tabs);
exit;
/**/

/**
 * A partir de aca puede añadir todos los grupos de tabs que sean necesarias para esta vista
 */
