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
    "label"=> $smarty->config_vars["tab_cites"]
,   "id_name"=>"cites"
,   "icon" => "fas fa-landmark m--font-success"
,   "new" => 1
);
//-------------------------------------------------------------

$item_tab[]=array(
    "label"=> $smarty->config_vars["tab_especie"]
,   "id_name"=>"especie"
,   "icon" => "fab fa-suse m--font-success"
,   "new" => 1
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
