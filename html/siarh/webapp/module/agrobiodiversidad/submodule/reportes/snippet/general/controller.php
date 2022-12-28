<?php
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $templateModuleAjax;

switch($accion) {
    /**
     * Página por defecto (index)
     */
    default:
        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj", $cataobj);
        $smarty->assign("type", $type);

        if($type=="update") {
            $item = $subObjItem->get_item($id, "usuario_permisos");
            $smarty->assign("item", $item);
        }
        $smarty->assign("subpage", $webm["sc_index"]);
        break;

    case 'itemupdatesql':
        if ($item['rol_itemid'] === '1') {
            $item['crear'] = 1;
            $item['editar'] = 1;
            $item['eliminar'] = 0;

        }
        if ($item['rol_itemid'] === '2') {
            $item['crear'] = 0;
            $item['editar'] = 0;
            $item['eliminar'] = 0;
        }
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_usuario_permisos", $type, "usuario_permisos");
        $core->print_json($respuesta);
        break;

}
