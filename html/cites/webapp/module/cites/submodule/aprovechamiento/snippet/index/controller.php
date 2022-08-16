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
         * sacamos las listas para los filtros
         */
        $objCatalog->conf_catalog_datos_general();
        $cataobj = $objCatalog->getCatalogList();

        $smarty->assign("cataobj", $cataobj);

        $grill_list = $objItem->get_grilla_list_sbm("index");
        $smarty->assign("grill_list", $grill_list);
        //print_struc($grill_list);exit;

        /**
         * usamos el template para mootools
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

    case 'itemUpdate':
        //$dbm->debug = true;
        $smarty->assign("type", $type);
        $smarty->assign("id", $id);

        if ($type == "update") {
            //$dbm->debug = true;
            $item = $objItem->get_item($id);
            $smarty->assign("item", $item);
            //print_struc($item);exit;
        }


        $menu_tab = $objItem->get_item_tab_sbm($type,"index");

        /**
         * Para sustitución, tabs
         */
        //echo $item["sustitucion_cites"]."----";
        if($item["sustitucion_cites"]==1){
            unset($menu_tab[3]);
            unset($menu_tab[6]);
        }else{
            unset($menu_tab[4]);
            unset($menu_tab[5]);
            if($item["estado_id"]!=7){
                unset($menu_tab[6]);
            }
        }
        //print_struc($menu_tab);exit();
        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "general");

        $smarty->assign("subpage", $webm["item_index"]);
        $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;
    /**
     * Creación de JSON
     */
    case 'lista':
        //$datatable_debug = true;
        $res = $objItem->get_item_datatable_Rows($especie_id);
        $core->print_json($res);
        break;

    case 'borrar':
        $res = $objItem->item_delete($id);
        $core->print_json($res);
        break;

    case 'resumen':
        $res = $objItem->get_resumen($item_id,0);

        $core->print_json($res);
        break;

    case 'enviar':
        $res = $objItem->enviar($item_id);
        $core->print_json($res);
        break;

    case 'imprime3':
        $objCatalog->conf_catalog_datos_general_print();
        $cataobj = $objCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);

        $item = $objItem->get_item($id);
        $smarty->assign("item",$item);

        $especie = $objItem->get_especie_list($id);
        $smarty->assign("especie", $especie);

        $objItem->imprime($item_id);
        break;
    case 'imprime':
        //echo "test de impresión 2";
        $objItem->imprime2($item_id);
        //exit;
        break;

    case 'sustituir':
        $templateModule = $templateModuleAjax;

        $smarty->assign("id", $id);


        $objCatalog->conf_catalog_sustitucion();
        $cataobj = $objCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);
        /**
         * Sacamos los datos CITES
         */
        $item = $objItem->get_item($id);
        $smarty->assign("item",$item);

        $smarty->assign("subpage", $webm["sustitucion_index"]);
       // $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;

    /**
     * Guarda detalles de sustitución
     */
    case 'guardar.detalle':
        $respuesta = $objItem->item_update($item,$id,"general");
        $core->print_json($respuesta);
        break;

}