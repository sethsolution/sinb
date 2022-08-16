<?php
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $templateModuleAjax;

switch($accion){
    /**
     * Página por defecto (index)
     */
    default:
        $smarty->assign("subpage",$webm["sc_index"]);
        break;
    case 'top':
        $menuTop = $subObjItem->getMenuTop();
        $smarty->assign("item",$menuTop);

        $smarty->assign("subpage",$webm["top"]);
        break;
    case 'menu':
        $smarty->assign("subpage",$webm["menu"]);
        break;
    case 'principal':

        $smarty->assign("subpage",$webm["principal"]);
        break;

    case 'izq':
        $menu = $subObjItem->getMenuIzquierdo($_POST["id"]);
        $smarty->assign("item",$menu);

        //$templateModule = $webm["template_ajax"];
        //print_struc($webm);exit;
        //$smarty->display($webm["menu_izq"]);
        //$smarty->assign("subpage",$webm["principal"]);
        $templateModule = $webm["menu_izq"];
        break;
}