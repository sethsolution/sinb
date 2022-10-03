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
        $gestionId=$_GET["gestion"];
        $smarty->assign("usuarioInfo", $objItem->obtener_permiso_usuarios());
        $grill_list = $objItem->get_grilla_list_sbm("item");
        //print_struc($grill_list);exit;
        $smarty->assign("grill_list", $grill_list);
        /**
         * usamos el template para mootools
         */
        $objCatalog->conf_catalog_datos_general();
        $cataobj = $objCatalog->getCatalogList();
        $smarty->assign("cataobj", $cataobj);
        if(isset($gestionId)){
            $smarty->assign("gestionId", $gestionId);
        }
        else{
        for($i=2019;$i<2050;$i++){
            if($cataobj["Gestion"][$i]==date("Y")){
                $smarty->assign("gestionId", $i);
                break;
            }
        }
        }
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("rol_itemId2", 1);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;
    /**
     * Creación de reportes
     */
    case 'reporte':
        $objItem->get_report($tipo);
        break;
    /**
     * Creación de JSON
     */
    case 'getItemList':
        $gestionId=$_GET["gestion"];
        $res = $objItem->get_item_datatable_Rows($gestionId);
        $core->print_json($res);
        break;
    case 'verGestion':
        
        $ver=$objItem->verificarGestion(); 
        $core->print_json($ver);
        break;
    case 'itemUpdate':
            $smarty->assign("rol_itemId", $tco["rol_itemId"]);
            $smarty->assign("type", $type);
            $smarty->assign("id", $id);
    
            $menu_tab = $objItem->get_item_tab_sbm($type,"index");
    
            $smarty->assign("menu_tab", $menu_tab);
            $smarty->assign("menu_tab_active", "general");
    
            if ($type == "update") {
                $item = $objItem->get_item($id, "tipo");
                $smarty->assign("item", $item);
            }
            $smarty->assign("subpage", $webm["item_index"]);
            $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;

    
    case 'codice':
        echo "es una mala llamada de un snippet";
        exit;
        break;

}