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
        //print_struc($CFGm->tabla);exit;
        //$objCatalog->conf_catalog_datos_general();
        //$cataobj = $objCatalog->getCatalogList();
        //$smarty->assign("cataobj", $cataobj);

        if ($_SESSION['userv']['itemId'] != 1) {
            $smarty->assign("privFace", $objItem->getUserPermisos($privFace));
        }
        
        $grill_list = $objItem->get_grilla_list_sbm("grilla_usuarios");
        $smarty->assign("grill_list", $grill_list);
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

    /**
     * Creación de JSON
     */
    case 'getItemList':
        $res = $objItem->get_item_datatable_Rows();
        $core->print_json($res);
        break;

    case 'itemUpdate':
        $smarty->assign("id", (int) $id);

        $menu_tab = $objItem->get_item_tab_sbm($type, "tab_usuarios");
        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "general");

        if ($type == "update") {
            $item = $objItem->get_item($id, "usuario_permisos");
            if (empty($item)) {
                $type = "new";
            }
            $smarty->assign("item", $item);
        }
        $smarty->assign("type", $type);
        $smarty->assign("subpage", $webm["item_index"]);
        $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;

    case 'getUserList':
        $res = $objItem->getUserList();
        echo json_encode(array('data' => $res));
        exit;
        break;

    case 'codice':
        echo "Es una mala llamada de un snippet.";
        exit();
        break;
        
}
