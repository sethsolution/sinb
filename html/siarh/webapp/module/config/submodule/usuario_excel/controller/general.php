<?
$subObjItem = new General();

switch($accion){

    /**
     * P�gina por defecto
     */
    default:
            $templateModule = $templateModuleAjax;
            if($type=="update"){
              $item = $subObjItem->getItem($id,0);
              $smarty->assign("item",$item);
              $smarty->assign("ProvinciaOptions",$objCatalog->getProvinciaOptions($item["departamentoId"]));
              $smarty->assign("municipioOptions",$objCatalog->getMunicipioOptions($item["provinciaId"]));
              $smarty->assign("listFuente",$subObjItem->dataFuente);
            }else{
                $item["gestionId"] = date("Y");
                $smarty->assign("item",$item);
            }
            /**
             * Carga de Catalogos
             */
            $smarty->assign("departamentoOptions",$objCatalog->getDepartamentoOptions());
            $smarty->assign("tipoOptions",$objCatalog->getTipoOption());
            

            /*************************************************************************/
            $smarty->assign("accion",$type);
            $smarty->assign("subpage",$templateItem_InfoGral);            
            
        break;
    
    case 'getProvincia':
            $list = $objCatalog->getProvinciaOptions($id,1);
         //   $options = $subObjItem->setOptions($listaux);
            echo json_encode($list);
            exit;
        break;
        
    case 'getMunicipio':
            $list = $objCatalog->getMunicipioOptions($id,1);
         //   $options = $subObjItem->setOptions($listaux);
            echo json_encode($list);
            exit;
        break;
    
}
