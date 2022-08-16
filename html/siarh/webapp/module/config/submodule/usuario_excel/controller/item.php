<?
$smarty->assign("titleSmodule","Exportar a Excel");
switch($accion){
    
default:
           // $templateModule = $templateModuleAjax;
            /**
             * Carga de Catalogos
             */
             $objCatalog->configCatalogListIndex();
             $cataobj = $objCatalog->getCatalogList();
             $cataobj["tipo"] = $objCatalog->getArrayTipoUsuario(0);
             $cataobj["activo"] = $objCatalog->getArrayCondicion();
             
             $smarty->assign("cataobj",$cataobj);
             $smarty->assign("subpage",$templateModuleIndexa);         
            
        break;
    
    case 'getExcel':
            @set_time_limit(0); 
            ini_set('memory_limit','8000M');
            $userprint = $objItem->getUserPrint();
            $objItem->get_excel_file($item,$userprint);

        exit;
            
        break;  
}
