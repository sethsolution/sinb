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
         * usamos el template para mootools
         */
        $menu_modulo_principal = $objItem->get_menu_principal();
        //print_struc($menu_modulo_principal);exit;

        $smarty->assign("menu_modulo_principal", $menu_modulo_principal);

        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

    /**
     * Creación de JSON
     */
    case 'getPhoto':
        $objItem->getPhoto($type);
        break;

}