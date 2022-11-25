<?PHP
/**
 * Configuración de los tabs a utilizarse en el snippet
 */

$tabs = array();
\Core\Core::setLenguage("tabItem"); //cargamos idioma

/**
 * Realizamos la configuración de los taps para cada grupo que utilicemos
 */
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> "Tipo Documento"
,   "id_name"=>"documento"
,   "icon" => "fas fa-network-wired m--font-success"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> "Proposito"
,   "id_name"=>"proposito"
,   "icon" => "fas fa-clipboard-check m--font-success"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> "Apendice"
,   "id_name"=>"apendice"
,   "icon" => "fas fa-sort-alpha-down m--font-success"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> "Unidad"
,   "id_name"=>"Unidad"
,   "icon" => "fas fa-sort-numeric-down m--font-success"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> "Origen"
,   "id_name"=>"origen"
,   "icon" => "fas fa-leaf m--font-success"
,   "new" => 0
);
//-------------------------------------------------------------

/**
 * Se añade el arreglo de tabs configurada a $tabs
 */
$group = "index";
$tabs[$group]= $item_tab;
unset($item_tab); // siempre se borrar la variable para iniciar una nueva configuración

/**
 * A partir de aca puede añadir todos los grupos de tabs que sean necesarias para esta vista
 */
