<?php
$gtv = "";
/**
 * Path del submodulo
 */
$path_sbm = $pathmodule."submodule/".$smoduleName."/";
$path_sbm_inc = $path_sbm."inc/";
$path_sbm_snippet = $path_sbm."snippet/";
$path_sbm_snippet_index = $path_sbm_snippet."index/";
/**
 * Incluimos class, class.catalog y tpl por defecto de Index
 */

include($path_sbm_snippet_index."/inc/tpl.php");

/* /
echo "path_sbm :".$path_sbm."<br>";
echo "path_sbm_inc:".$path_sbm_inc."<br>";
echo "path_sbm_snippet :".$path_sbm_snippet."<br>";
echo "path_sbm_snippet_index:".$path_sbm_snippet_index."<br>";
/**/
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

if($countOpt == 2) $subcontrol = $accion_par[0];

$sub_inc = $pathmodule."submodule/".$smoduleName."/inc/inc.php";
if (file_exists($sub_inc)) include($sub_inc);

/**
 * Conexión a las diferentes bases de datos
 */
$inc_db_sbm = $path_sbm_inc."db.php";
if(!file_exists($inc_db_sbm)){ echo "No existe el archivo inc :".$inc_file;exit;}
include_once($inc_db_sbm);

$inc_db_sbm = $path_sbm_inc."db.referencia.php";
if(!file_exists($inc_db_sbm)){ echo "No existe el archivo inc :".$inc_file;exit;}
include_once($inc_db_sbm);


switch($countOpt){
    /**
     * Controlador Principal
     */
    case 1:

        /**
         * mandamos mensaje que esta ingresando a un módulo especifico al index
         */
        if($smoduleName == "index" && $subsistema["titulo"]!="" ){

            $texto = "\xF0\x9F\x9A\x80 <b>[".$subsistema["carpeta"]."]</b>:Usuario: " . $_SESSION["userv"]["usuario"]." entro a: ".$subsistema["titulo"];
            $core->telegram_log_modulo($texto);

        }


        /**
         * inc
         */
        $inc_file = $path_sbm_snippet_index."inc/inc.php";
        $subcontrol ="index";
        if(!file_exists($inc_file)){
            echo "No existe el archivo inc :".$inc_file;exit;
        }
        include($inc_file);




        /**
         * Grilla y Tabs
         */
        $grilla_file = $path_sbm."snippet/".$subcontrol."/inc/grilla.php";
        if(is_file($grilla_file)) include_once($grilla_file);
        $grilla_file = $path_sbm."snippet/".$subcontrol."/inc/tab.php";
        if(is_file($grilla_file)) include_once($grilla_file);
        $inc_file = $path_sbm."snippet/".$subcontrol."/inc/campos.php";
        if(is_file($inc_file)) include_once($inc_file);

        /**
         * objeto principal
         **/
        include($path_sbm_snippet_index."/class.php");
        include($path_sbm_snippet_index."/class.catalog.php");
        $objItem = new Index();
        $objCatalog = new Catalogo();

        /**
         * controlador
         */
        $accion_file = $path_sbm_snippet_index."controller.php";
        if(!file_exists($accion_file)){
            echo "no existe el controlador en index:".$accion_file;exit;
        }
        include($accion_file);


        break;
    /**
     * Controladores Secundarios
     */
    case 2:
        $subcontrol = $accion_par[0];
        $accion = $accion_par[1];

        $path_sbm_snippet_sbc = $path_sbm_snippet.$subcontrol."/";
        /**
         * inc
         */
        $inc_file = $path_sbm_snippet_sbc."inc/inc.php";
        if(!file_exists($inc_file)){
            echo "No existe el archivo inc :".$inc_file;exit;
        }
        include($inc_file);

        /**
         * Grilla y Tabs
         */
        $inc_file = $path_sbm."snippet/".$subcontrol."/inc/grilla.php";
        if(is_file($inc_file)) include_once($inc_file);
        $inc_file = $path_sbm."snippet/".$subcontrol."/inc/tab.php";
        if(is_file($inc_file)) include_once($inc_file);
        $inc_file = $path_sbm."snippet/".$subcontrol."/inc/campos.php";
        if(is_file($inc_file)) include_once($inc_file);


        /**
         * objeto principal
         **/
        include($path_sbm_snippet_index."/class.php");
        include($path_sbm_snippet_index."/class.catalog.php");
        $objItem = new Index();
        $objCatalog = new Catalogo();

        /**
         * Includes de configuración de TPL
         */
        $tpl_file = $path_sbm_snippet_sbc."inc/tpl.php";
        if(!file_exists($tpl_file)){
            echo "No existe el archivo tpl :".$tpl_file;exit;
        }
        //$templateDir_sc = "../.".$path_sbm_snippet.$subcontrol."/view/";
        $templateDir_sc = "";
        $smarty->assign("templateDir_sc",$templateDir_sc);
        include($tpl_file);
        /**
         * Classe
         */
        $class_file = $path_sbm_snippet_sbc."class.php";
        if(!file_exists($class_file)){
            echo "no existe el archivo class:".$class_file;exit;
        }
        include($class_file);
        $subObjItem = new Snippet();
        /**
         * Classe sub Catalogo
         */
        $class_file = $path_sbm_snippet_sbc."class.catalog.php";

        if(!file_exists($class_file)){
            echo "no existe el archivo class:".$class_file;exit;
        }
        include($class_file);
        $subObjCatalog = new Subcatalogo();
        /**
         * Controlador
         */
        $accion_file = $path_sbm_snippet_sbc."controller.php";
        if(!file_exists($accion_file)){
            echo "no existe el archivo controller:".$accion_file;exit;
        }
        include($accion_file);
        /**
         * Path del controlador
         */
        $smarty->assign("subcontrol",$subcontrol);





        break;

    default:  echo "<center><font color='red'>Error</font></center>";
        exit;
        break;
}
/**
 * Generamos los lugares de los templates de sistema
 */
$smarty_template = array();
$smarty_template[] = $CFG->smarty_template;
$smarty_template[] = "./module/core/template/frontend_core/";
$smarty_template[] = $path_sbm."snippet/".$subcontrol."/view/";
$smarty_template[] = $pathmodule."template/frontend/";
$smarty->setTemplateDir($smarty_template);
/* /
print_struc($smarty_template);
print_struc($smarty->template_dir);
exit;
/**/
/**
 * Desplegamos la página
 */

$smarty->display($templateModule);