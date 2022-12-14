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
    "label"=>"Departamentos"
,   "id_name"=>"reporte"
,   "sub_control"=>"reporte"
,   "active"=>"0"
,   "icon" => "fa fa-chart-pie"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=>"ICAS"
,   "id_name"=>"icas"
,   "sub_control"=>"icas"
,   "active"=>"0"
,   "icon" => "fas fa-globe"
,   "new" => 0
);
//-------------------------------------------------------------
/*
$item_tab[]=array(
    "label"=>"Generación Distribuida"
,   "id_name"=>"gd"
,   "sub_control"=>"gd"
,   "active"=>"0"
,   "icon" => "fa fa-database"
,   "new" => 0
);
*/

/*
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> $smarty->config_vars["tabGroups"]
,   "id_name"=>"group"
,   "icon" => "flaticon-pie-chart m--font-success"
,   "new" => 0
);
//-------------------------------------------------------------
$item_tab[]=array(
    "label"=> $smarty->config_vars["tabModules"]
,   "id_name"=>"module"
,   "icon" => "flaticon-folder-2 m--font-success"
,   "new" => 0
);*/
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
