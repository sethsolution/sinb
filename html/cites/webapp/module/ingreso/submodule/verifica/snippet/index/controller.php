<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 17/06/2020
 * Time: 19:14
 */

$templateModule = $templateModuleReg;

switch($accion) {
    /**
     * Página por defecto
     */
    default:

        /**
         * usamos el template para mootools
         */


        $item = $objItem->verifica($code);
        if (isset($item["itemId"]) && $item["itemId"]!="" ){
            /**
             * Catalogos
             */
            $objCatalog->conf_catalog_datos_general_print();
            $cataobj = $objCatalog->getCatalogList();
            $cataobj["tipo_documento"] = $objCatalog->get_tipo_documento_options();
            $smarty->assign("cataobj" , $cataobj);

            $item_id = $item["itemId"];
            $especie = $objItem->get_especie_list($item_id);
            $smarty->assign("especie" , $especie);
            $smarty->assign("item" , $item);

            print_struc($especie);exit;
        }

        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

    case 'enviar':
        $smarty->assign("subpage", $webm["email"]);
        $res = $objItem->restablece($user, $pass, $empresa, $nombre);
        $core->print_json($res);
        break;
    case 'guardar':
        $smarty->assign("subpage", $webm["email"]);
        $respuesta = $objItem->item_update($item,"general");
        $core->print_json($respuesta);
        break;

    case 'verifica':
        $smarty->assign("subpage", $webm["email_valida"]);
        $res = $objItem->valida_email($c,$e);
        //$res["resp"]=0;
        //$core->print_json($res);

        $smarty->assign("verifica", $res["resp"]);

        $smarty->assign("subpage", $webm["verifica"]);
        $smarty->assign("subpage_js", $webm["verifica_js"]);

        break;
}