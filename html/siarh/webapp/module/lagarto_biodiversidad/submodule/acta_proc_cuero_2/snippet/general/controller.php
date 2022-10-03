<?php
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $templateModuleAjax;

$filas=$_POST;
switch($accion){

    /**
     * Página por defecto (index)
     */

    default:
        $filas=$objItem->obtenerFilasReporte($id);
        $smarty->assign("filas",$filas);
        $smarty->assign("type",$type);
        $rol_itemId=$objItem->obtenerTCO();
        $smarty->assign("rol_itemId",$rol_itemId["rol_itemId"]);
        if($type=="update"){
            $item = $objItem->get_item($id,"tipo");
            $smarty->assign("item",$item);
        }
        else{
            echo "No puede crear datos.";exit;

        }

        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->obtCurtiembre();
        // print_struc($cataobj);

        $smarty->assign("cataobj",$cataobj);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;



    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item,$itemId,"acta_cuero",$type);
        $core->print_json($respuesta);
        break;

    case 'get.tipo':
        $item = $subObjCatalog->get_tipo_options($id);
        $core->print_json($item);
        break;
    case 'get.unidad':
        $item = $subObjCatalog->get_unidad_options($id);
        $core->print_json($item);
        break;

}