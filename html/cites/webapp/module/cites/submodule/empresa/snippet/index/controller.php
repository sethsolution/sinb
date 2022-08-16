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

        if($item["tipo_id"] == 12 or $item["tipo_id"] == 10){
            unset($menu_tab[1]);
        }
        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "general");

        //if($item['tipo_id'] == 11 ){
          //  $smarty->assign("menu_tab_disabled", "requisitos");
            //print_struc($menu_tab);exit();
        //}
       // print_struc($menu_tab);exit();

        /**
         * usamos el template para mootools
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

    case 'enviar':
        $res = $objItem->enviar($item_id);
        $core->print_json($res);
        break;

}


