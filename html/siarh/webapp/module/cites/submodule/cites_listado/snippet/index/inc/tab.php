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
    "label"=>"Paso 1"
,   "id_name"=>"general"
,   "sub_control"=>"general"
,   "active"=>"1"
,   "icon" => "flaticon-share m--font-success"
,   "new" => 1
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"Paso 2"
,   "id_name"=>"especie"
,   "sub_control"=>"especie"
,   "active"=>"0"
,   "icon" => "fa fa-layer-group"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"Paso 3"
,   "id_name"=>"requisitos"
,   "sub_control"=>"requisitos"
,   "active"=>"0"
,   "icon" => "fa fa-archive"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"Paso 4"
,   "id_name"=>"pagos"
,   "sub_control"=>"pagos"
,   "active"=>"0"
,   "icon" => "fa fa-money-bill-alt"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"Información Final"
,   "id_name"=>"numero"
,   "sub_control"=>"numero"
,   "active"=>"0"
,   "icon" => "fa fa-check-square m--font-success"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"Sustitución Paso 1"
,   "id_name"=>"sustitucionrequisitos"
,   "sub_control"=>"sustitucionrequisitos"
,   "active"=>"0"
,   "icon" => "fa fa-archive m--font-primary"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"Sustitución Paso 2"
,   "id_name"=>"sustitucionpagos"
,   "sub_control"=>"sustitucionpagos"
,   "active"=>"0"
,   "icon" => "fa fa-money-bill-alt m--font-primary"
,   "new" => 0
);

//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"Sustituciones"
,   "id_name"=>"sustituciones"
,   "sub_control"=>"sustituciones"
,   "active"=>"0"
,   "icon" => "fa fa-money-bill-alt"
,   "new" => 0
);

//-------------------------------------------------------------

/*
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"Estructura Financiera"
,   "id_name"=>"estructura"
,   "sub_control"=>"estructura"
,   "active"=>"0"
,   "icon" => "flaticon-share m--font-success"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"Desembolso "
,   "id_name"=>"desembolso"
,   "sub_control"=>"desembolso"
,   "active"=>"0"
,   "icon" => "flaticon-folder-2 m--font-success"
,   "new" => 0
);
*/
//-------------------------------------------------------------
/*
$item_tab[]=array(
    "label"=>"Enmienda "
,   "id_name"=>"enmienda"
,   "sub_control"=>"enmienda"
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
