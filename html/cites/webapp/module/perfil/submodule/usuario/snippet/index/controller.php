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

        $item = $objItem->get_item();
        $smarty->assign("item",$item);
        /**
         * usamos el template para mootools
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

    case 'itemupdatesql':
        $privFace["editar"] = true;
        $respuesta = $objItem->item_update($item,"datos_general");
        $core->print_json($respuesta);
        break;

}