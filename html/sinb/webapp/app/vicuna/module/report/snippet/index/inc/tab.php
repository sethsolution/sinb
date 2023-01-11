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
    "label"=> $smarty->config_vars["tab_esquila"]
,   "id_name"=>"esquila"
,   "icon" => "fas fa-landmark m--font-success"
,   "new" => 1
);
//-------------------------------------------------------------

$item_tab[]=array(
    "label"=> $smarty->config_vars["tab_vicunas"]
,   "id_name"=>"vicunas"
,   "icon" => "fab fa-sticker-mule m--font-success"
,   "new" => 1
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> $smarty->config_vars["tab_edad"]
,   "id_name"=>"edad"
,   "icon" => "fab fa-sticker-mule m--font-success"
,   "new" => 1
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> $smarty->config_vars["tab_condicion"]
,   "id_name"=>"condicion"
,   "icon" => "fas fa-plus-circle m--font-success"
,   "new" => 1
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> $smarty->config_vars["tab_parasito"]
,   "id_name"=>"parasito"
,   "icon" => "fab fa-hubspot m--font-success"
,   "new" => 1
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> $smarty->config_vars["tab_fibra"]
,   "id_name"=>"fibra"
,   "icon" => "fas fa-poll m--font-success"
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
