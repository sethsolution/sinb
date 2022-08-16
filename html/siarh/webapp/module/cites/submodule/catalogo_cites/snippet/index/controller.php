<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:27
 */

switch($accion) {
    /**
     * Página por defecto
     */
    default:
        /**
         * Cargamos catalogos necesarios
         */

        $menu_tab = $objItem->get_item_tab_sbm($type,"index");
        //print_Struc( $menu_tab);exit;
        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "tipoorigen");
        /**
         * usamos el template para mootools
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;
}


