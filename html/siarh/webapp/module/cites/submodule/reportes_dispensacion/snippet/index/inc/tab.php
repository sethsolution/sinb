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
    "label"=>"Reporte anual Bolivia"
,   "id_name"=>"anualbo"
,   "sub_control"=>"anualbo"
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
