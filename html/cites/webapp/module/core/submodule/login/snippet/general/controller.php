<?php
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $templateModuleAjax;

switch($accion){

    /**
     * Página por defecto (index)
     */
    default:

        $smarty->assign("type",$type);
        if($type=="update"){
            $item = $objItem->get_item($id,"c_ip_publica");
            $smarty->assign("item",$item);
        }


        //print_struc($CFGm->tabla);
        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();
        //print_struc($cataobj);exit;
        $smarty->assign("cataobj",$cataobj);
        //print_struc($cataobj);exit;
        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'itemupdatesql':
        //print_struc($item);exit;
        $respuesta = $subObjItem->item_update($item,$itemId,"c_ip_publica",$type);
        $core->print_json($respuesta);
        break;

}
