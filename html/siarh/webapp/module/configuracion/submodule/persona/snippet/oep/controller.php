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
        //$core->writeLog($_REQUEST,__FILE__,__LINE__);

        /**
         * Sacamos los datos del usuario
         */
        $item = $objItem->get_item($id, "persona");
        $smarty->assign("item", $item);
        $core->writeLog($item,__FILE__,__LINE__);
        /**
         * Sacamos los datos de la OEP
         */
        //$dbm->debug = true;
        $item_oep = $objItem->get_item($item["ci_num"], "oep_persona");
        $smarty->assign("item_oep", $item_oep);
        //$core->writeLog($item["ci_num"],__FILE__,__LINE__);
        $core->writeLog($item_oep,__FILE__,__LINE__);


        $smarty->assign("subpage",$webm["sc_index"]);
        break;
}