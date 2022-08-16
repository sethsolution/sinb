<?
$smarty->assign("titleSmodule","Reporte");
switch($accion){
        
    default:
            /** Carga de Catalogos*/
             $objCatalog->configCatalogListIndex();
             $cataobj = $objCatalog->getCatalogList();
             $cataobj["tipo"] = $objCatalog->getArrayTipoUsuario(0);
             $cataobj["activo"] = $objCatalog->getArrayCondicion();
             
             $smarty->assign("cataobj",$cataobj);
            /*************************************************************************/
            $smarty->assign("subpage",$templateModuleIndexa);     
        break;

}
