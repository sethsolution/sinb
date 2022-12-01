<?PHP
/**
 * Path del submodulo
 */
$path_sbm = APP_PATH."module/".APP_MODULE."/";
$path_sbm_inc = $path_sbm."inc/";
$path_sbm_snippet = $path_sbm."snippet/";
$path_sbm_snippet_index = $path_sbm_snippet."index/";
/**
 * Se encuentra en action.path.php de cada módulo
 */
if (!isset($path_gestion) and !$path_gestion){
    if(!isset($accion)){
        /**
         * Si no existe acción se va directo al controlador por defecto item.php
         */
        $countOpt = 1;
    }else{
        $accion_par = explode("_",$accion);
        $countOpt = count($accion_par);
    }
}

if(isset($id)){
    $smarty->assign("id",$id);
}
/**
 * Capa web base para interfaz principal
 */
include(HOME_PATH."template.php");
/**
 * Fin de capa base de interfaz principal
 */

if($countOpt == 2) {
    $accion = $accion_par[1];
    $subcontrol = $accion_par[0];
}elseif ($countOpt == 1){
    $subcontrol ="index";
}

$path_sbm_snippet_control = $path_sbm_snippet.$subcontrol;

/**
 * Recursos de Idioma
 * ------------------------------------------------------------------------
 */
if(!isset($_SESSION["lng"])){
    $_SESSION["lng"]= $_ENV['APP_LANGUAGE'];
}

//$lng = $_SESSION["lng"].".conf";
//$lng = $_SESSION["lng"];
$lng = "pt";

$lng = "es";
$lng = "es";
$smarty->assign("lng",$lng);
$languageSbm = $path_sbm_snippet_control."/language/".$lng.".conf";
//$smarty->setConfigDir($path_sbm_snippet_control."/language");
//echo APP_PATH."language/".$lng.".conf<----------";exit;
/**
 * Configuración de lenguaje del módulo "Aplicación"
 */
$languageModule = APP_PATH."language/".$lng.".conf";
if(file_exists($languageModule))$smarty->configLoad($languageModule);

/**
 * configuración de lenguaje global
 */
$languageGlobal = "./language/".$lng.".conf";
if(file_exists($languageGlobal))$smarty->configLoad($languageGlobal);
/**
 * Include
 * ------------------------------------------------------------------------
 */
$inc_file = $path_sbm_inc."inc.php";
if(!file_exists($inc_file)){ echo "No existe el archivo inc.php :".$inc_file;exit;}
include($inc_file);
/**
 * Conexión a las diferentes bases de datos
 */
$inc_file = $path_sbm_inc."db.php";
if(!file_exists($inc_file)){ echo "No existe el archivo db.php :".$inc_file;exit;}
include_once($inc_file);

$inc_file = $path_sbm_inc."db.referencia.php";
if(!file_exists($inc_file)){ echo "No existe el archivo db.referencia.php :".$inc_file;exit;}
include_once($inc_file);

/**
 * ====================================================================================================
 */
/**
 * 1: es para el módulo principal
 * 2: es para el módulo tipo taps
 * solo existen estos 2 casos
 */

/**
 * Ejecutamos Secuencias en Conjunto
 */

/**
 * inc
 */
$inc_file = $path_sbm_snippet_control."/inc/inc.php";
if(!file_exists($inc_file)){
    echo "No existe el archivo inc :".$inc_file;exit;
}
include($inc_file);

/**
 * Grilla y Tabs
 */
$inc_file = $path_sbm_snippet_control."/inc/grids.php";
if(is_file($inc_file)) include_once($inc_file);
$inc_file = $path_sbm_snippet_control."/inc/tab.php";
if(is_file($inc_file)) include_once($inc_file);
$inc_file = $path_sbm_snippet_control."/inc/fields.php";
if(is_file($inc_file)) include_once($inc_file);

/**
 * objeto principal, genera un objeto siempre de la clase principal
 **/
include($path_sbm_snippet_index."/Index.php");
include($path_sbm_snippet_index."/Catalog.php");
/**
 * Includes de configuración de TPL
 */
$inc_file = $path_sbm_snippet_control."/inc/tpl.php";
if(!file_exists($inc_file)){
    echo "No existe el archivo tpl :".$inc_file;exit;
}
include($inc_file);
/**
 * Archivos y objetos necesarios para op = 2
 */
if($countOpt == 2) {
    /**
     * Classe
     */
    $inc_file = $path_sbm_snippet_control."/Index.php";
    if(!file_exists($inc_file)){
        echo "no existe el archivo class:".$inc_file;exit;
    }
    include($inc_file);
    /**
     * Classe sub Catalogo
     */
    $inc_file = $path_sbm_snippet_control."/Catalog.php";
    if(!file_exists($inc_file)){
        echo "no existe el archivo class:".$inc_file;exit;
    }
    include($inc_file);
}

/**
 * controlador
 */
$inc_file = $path_sbm_snippet_control."/controller.php";
if(!file_exists($inc_file)){
    echo "no existe el controlador en index: ".$inc_file;exit;
}

include($inc_file);

/**
 * Path del controlador
 */
$smarty->assign("subcontrol",$subcontrol);

/**
 * Generamos los lugares de los templates de sistema
 */
$smarty_template = array();

$smarty_template[] = "./app/core/template/";
$smarty_template[] = $path_sbm."snippet/".$subcontrol."/view/";
$smarty_template[] = APP_PATH."template/";
$smarty->setTemplateDir($smarty_template);

//print_struc($smarty_template);
//exit;
/* /
print_struc($smarty_template);
print_struc($smarty->template_dir);
exit;
/**/
/**
 * Desplegamos la página
 */
$smarty->display($templateModule);