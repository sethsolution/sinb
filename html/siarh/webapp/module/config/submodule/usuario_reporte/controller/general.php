<?
$subObjItem = new General();

switch($accion){

    /**
     * Página por defecto (index)
     */
    default:

           /* $item = $subObjItem->getItem($iddep);
            $smarty->assign("item",$item);*/
            if(!empty($idins))
            $url = "&idins[]=".implode("&idins[]=", $idins);
            if(!empty($tipo))
            $url .= "&tipo[]=".implode("&tipo[]=", $tipo);
            if(!empty($idgru))
            $url .= "&idgru[]=".implode("&idgru[]=", $idgru);
            if(!empty($activo))
            $url .= "&activo[]=".implode("&activo[]=", $activo);
            $smarty->assign("url",$url);
            //$res["viewTabla"] = $smarty->fetch($templateTabla);

            $res["viewGrafica"] = $smarty->fetch($templateGrafica);

            echo json_encode($res);
            exit;
        break;
    
    case 'grafica':
            $templateModule = $templateModuleAjax;

            $data["institucion"] = $idins;
            $data["tipo"] = $tipo;
            $data["grupo"] = $idgru;
            $data["activo"] = $activo;
            
            $item = $subObjItem->getList($tab, $data);
            $smarty->assign("item",$item);
                  
            $listcolor = $objCatalog->getArrayColor();
            
            $smarty->assign("listColor",$listcolor);
            $smarty->assign("item",$item);
            $smarty->assign("listTipo",$listTipo);
            $smarty->assign("tipo",$tab);
            $smarty->assign("subpage",$templateGraficaItem);          
            
        break;
    
}
