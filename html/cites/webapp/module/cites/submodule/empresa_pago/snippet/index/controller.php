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
        $item = $objItem->get_item();
        $smarty->assign("item", $item);
        /**
        print_struc($item);
        print_struc($_SESSION["empresa"]);
        exit;
        /**/

        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "pagos");
        /**
         * usamos el template para mootools
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;
}


