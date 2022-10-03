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
            //print_struc($menu_modulo_principal);exit;

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
               $smarty->assign("gestionVer", TRUE);
        if(isset($gestionId)){
            $smarty->assign("gestionId", $gestionId);
        }
        else{
        for($i=2019;$i<2101;$i++){
            if($cataobj["Gestion"][$i]==date("Y")){
                $smarty->assign("gestionId", $i);
                break;
            }
	if($i==2100){
                $smarty->assign("gestionVer", FALSE);
	}
        }
        }
        $smarty->assign("subpage", $webm["index"]);
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
        
	if($_GET["gestion"]!=""){
        	$gestionId=$_GET["gestion"];
        	$res = $objItem->get_item_datatable_Rows($gestionId);}
	else{
        	$res = $objItem->get_item_datatable_Rows(2019);}
        $core->print_json($res);
        break;

    case 'itemUpdate':
        $smarty->assign("usuarioInfo", $objItem->obtener_permiso_usuarios());
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

    case 'itemDelete':
        $res = $objItem->item_delete($id);
        $core->print_json($res);
        break;
    case 'codice':
        echo "es una mala llamada de un snippet";
        exit;
        break;

}