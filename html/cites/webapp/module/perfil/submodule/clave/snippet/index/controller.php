<?php


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
        //print_struc($privFace);
        $respuesta = $objItem->item_update($item,"datos_general");
        $core->print_json($respuesta);
        break;
}