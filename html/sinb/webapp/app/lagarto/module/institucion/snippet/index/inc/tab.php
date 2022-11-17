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
    "label"=> $smarty->config_vars["tabGeneral"]
,   "id_name"=>"general"
,   "icon" => "fas fa-dungeon m--font-success"
,   "new" => 1
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> $smarty->config_vars["tab_inscripcion"]
,   "id_name"=>"inscripcion"
,   "icon" => "fas fa-calendar-alt m--font-success"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> $smarty->config_vars["tab_ubicacion"]
,   "id_name"=>"ubicacion"
,   "icon" => "fas fa-map-marker m--font-success"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> $smarty->config_vars["tab_cupo"]
,   "id_name"=>"cupo"
,   "icon" => "fas fa-list m--font-success"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> $smarty->config_vars["tab_adjunto"]
,   "id_name"=>"adjunto"
,   "icon" => "fas fa-paperclip m--font-success"
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
