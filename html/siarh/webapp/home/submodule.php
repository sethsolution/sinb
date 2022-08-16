<?php
//include ($pathmodule."submodule/".$smoduleName."/classes/class.".$smoduleName.".php");
include($pathmodule."submodule/".$smoduleName."/classes/class.index.php");
include($pathmodule."submodule/".$smoduleName."/classes/class.catalog.php");
include($pathmodule."submodule/".$smoduleName."/inc/template.php");

$gtv = "";

//$smarty->assign("titleSmodule","Reuso");
$smarty->assign("getModule",$getModule);

if(!isset($accion)){
    /**
     * Si no existe acción se va directo al controlador por defecto item.php
     */
    $countOpt = 1;
}else{
    $accion_par = explode("_",$accion);
    $countOpt = count($accion_par);
}    

if(isset($id)){
  $smarty->assign("id",$id); 
}

/**
 * Capa web base para interfaz principal
 */

include($CFG->homeSis."template.php");

/**
 * Fin de capa base de interfaz principal
 */


/**
 * Path del submodulo
 */
$path_sbm = $pathmodule."submodule/".$smoduleName."/";
$path_inc_sbm = $pathmodule."submodule/".$smoduleName."/inc/";

if($countOpt == 2) $subcontrol = $accion_par[0];

$sub_inc = $pathmodule."submodule/".$smoduleName."/inc/inc.php";
if (file_exists($sub_inc)) include($sub_inc);
/**
 * objeto principal
 **/
$objItem = new Index();
$objCatalog = new Catalogo();



$smarty_template = array();
$smarty_template[] = $CFG->smarty_template;
$smarty_template[] = "./module/core/template/frontend_core/";
$smarty_template[] = $path_sbm."template/";
//$smarty_template[] = $pathmodule."template/frontend/";
$smarty->setTemplateDir($smarty_template);

/* /
print_struc($smarty_template);
print_struc($smarty->template_dir);
exit;
/**/


switch($countOpt){
    /**
     * Controlador Principal
     */
    case 1:

        $accion_file = $path_sbm."controller/item.php";
        if(!file_exists($accion_file)){
            $accion_file = $path_sbm."controller/index.php";
        }
        include($accion_file);
        break;
    /**
     * Controladores Secundarios
     */
    case 2:
        $subcontrol = $accion_par[0];
        $accion = $accion_par[1];
        /**
         * Includes de configuración de TPL
         */
        $subcontrolTpl=$path_sbm."inc/".$subcontrol.".tpl.php";
        if(!file_exists($subcontrolTpl)){
            $subcontrolTpl=$path_sbm."inc/template/".$subcontrol.".tpl.php";
            include_once($subcontrolTpl);
        }else{
            include_once($subcontrolTpl);
        }


        //include classe
        $subinclude = $path_sbm."classes/class.".$subcontrol.".php";
        if(file_exists($subinclude))
            include($subinclude);

        $smarty->assign("subcontrol",$subcontrol);
        //include controlar
        include($path_sbm."controller/".$subcontrol.".php");
        break;

    default:  echo "<center><font color='red'>Error</font></center>";
        exit;
        break;
}



$smarty->display($templateModule);