<?php
//include("./lib/smarty/libs/Smarty.class.php");
$smarty = new Smarty();
$smarty_dir_web = $CFG->smarty_template;

$smarty->setTemplateDir($CFG->smarty_template);
$smarty->compile_dir = $CFG->smarty_compiler;
$smarty->cache_dir = $CFG->smarty_cache;
$smarty->config_dir = $CFG->smarty_config;
/* Creando la carpeta de template */
if(!file_exists($smarty->compile_dir)) {
	mkdir($smarty->compile_dir,0777);
}
/*Variables de smarty genericas*/
$smarty->assign('templateDir', $smarty_dir_web);

if(isset($_SESSION["userv"])){
    $smarty->assign("user",$_SESSION["userv"]["usuario"]);
    $smarty->assign("userName",$_SESSION["userv"]["nombre"]." ".$_SESSION["userv"]["apellido"] );

    if($_SESSION["userv"]["portada"]==1 && file_exists($CFG->data."config/listaUsuarios/".$_SESSION["userv"]["itemId"]."/thumbails/a_".$_SESSION["userv"]["itemId"].".jpg")){
      $randNum = rand(1,100);
      $smarty->assign("dirPhoto","index.php?module=config&smodule=usuario_perfil&accion=item_getPhoto&type=1&itemId=".$_SESSION["userv"]["itemId"]."&rand=".$randNum);
    }else{
      $smarty->assign("dirPhoto",$smarty->template_dir."images/icon/customers.png");
    }
        
}

$dirTheme = $smarty->template_dir;
$smarty->assign('languageFile',$CFG->language.".txt");
$smarty->assign('urlApp',$CFG->urlApp);
$smarty->assign('snir',$CFG->snir);
/* Datos para realizar el debug correspondiente */
if ($CFG->debugSmarty){
	$smarty->compile_check = true;
	$smarty->debugging = true;
}