<?

if($parentGestion!=""){
    
	$guia = $objCatalog->guia($parentGestion,$parentPadre,$parentEntidad);
   //echo $parentGestion,$parentPadre;
	$smarty->assign("guia",$guia);
	$gtv.="&parent=".$parent."&page=".$page;
    
}
$smarty->assign("titleSmodule","Categorias");

switch($accion){
    case 'getItemList':
            $res = $objItem->convertDatatableRows($_GET);
            echo $res;
            exit;
    break;
    
   case 'getGestionList':
        $res = $objItem->convertDatatableRows_gestion($_GET);
                         echo $res;
                         exit;
    break;
    
    case 'getPadresList':
          $res = $objItem->convertDatatableRows_padres($_GET,$parentGestion);
                         echo $res;
                         exit;
    break;
   case 'getEntidadesList':
        $res = $objItem->convertDatatableRows_entidades($_GET,$parentGestion,$parentPadre);
                         echo $res;
                         exit;
   break; 

        
     case 'entidadPadreUpdate': if($type=="update"){
                    	 $item = $objItem->getItem($id);
                    	 $smarty->assign("item",$item);
                        
                         $listPadres = $objCatalog->gesListPadres($parentGestion,$parentEntidad,null);
                         $smarty->assign("listPadres",$listPadres);                        
                          }
                         $listEntidades = $objCatalog->getEntidades($parentGestion,$item['entidadId']);
                         $smarty->assign("listEntidades",$listEntidades); 
                                    
                         $listNiveles = $objCatalog->getNiveles();
                         $smarty->assign("listNiveles",$listNiveles); 
                                      
                         $smarty->assign("parentGestion",$parentGestion);	
                         
    	                 $smarty->assign("id",$id);
                         
    	                 $smarty->assign("subpage",$templateModuleEntidadPadreForm);
    	                 $smarty->assign("accion",$type);
        break; 
    case 'entidadUpdate': if($type=="update"){
                    	 $item = $objItem->getItem($id);
                    	 $smarty->assign("item",$item);
                         $listPadres = $objCatalog->gesListPadres($parentGestion,$parentEntidad,$parentPadre);
                         $smarty->assign("listPadres",$listPadres);                        
                          }
                         $listEntidades = $objCatalog->getEntidades($parentGestion,$item['entidadId']);
                         $smarty->assign("listEntidades",$listEntidades); 
                                    
                         $listNiveles = $objCatalog->getNiveles();
                         $smarty->assign("listNiveles",$listNiveles); 
                         

                                      
                         $smarty->assign("parentGestion",$parentGestion);
                         $smarty->assign("parentPadre",$parentPadre);	                         
    	                 $smarty->assign("id",$id);
                         
    	                 $smarty->assign("subpage",$templateModuleEntidadForm);
    	                 $smarty->assign("accion",$type);
        break; 
        
    case 'entidadPadrenewsql': $res = $objItem->entidadPadreSave($item);
                        echo  json_encode($res);
                        exit;
        break;
   case 'entidadPadreupdatesql': $res = $objItem->entidadPadreUpdate($item,$id);
                        echo  json_encode($res);
                        exit;
        break; 
   case 'entidadnewsql': $res = $objItem->entidadSave($item);
                        echo  json_encode($res);
                        exit;
        break;
   case 'entidadupdatesql': $res = $objItem->entidadUpdate($item,$id);
                        echo  json_encode($res);
                        exit;
        break; 
                    
    case 'itemnewsql':  $res = $objItem->saveItem($item);
                        echo  json_encode($res);
                        exit;
        break;
    
    case 'itemupdatesql': $res = $objItem->updateItem($item,$id);
                          echo json_encode($res);
                          exit;
    break;

  
     case 'itemDelete':  $tot=$objItem->totEntidadesHijo($gestionId,$entidadId);
                      
                        if($tot==0){
                            $tot=$objItem->itemDelete($id);
                         echo 1;
                        }else{
                            echo 2;
                       }
                     	exit;
        break;
    case 'entidadPadreDelete':
                 $tot=$objItem->totEntidadesHijo($gestionId,$entidadId);
                      
                        if($tot==0){
                            $tot=$objItem->entidadPadreDelete($id);
                         echo 1;
                        }else{
                            echo 2;
                       }
                     	exit;
        break;
    case 'verifyItem':  $res=$objItem->verifyItemSaved($gestion,$entidad,$nivel);
                          echo $res;
                       
                     	exit;
    break;
    case 'deleteData':
            $res = $objItem->deleteItem($id,$tabla);
            echo json_encode($res);
        exit;
    break;
        case 'saveItemsql':
                if ($caso == "new")
                    $res = $objItem->saveItem($item, $tabla);
                else if ($caso=="update"){
                    $res = $objItem->updateItem($item,$tabla,$id);
                }
                echo json_encode($res);
                exit;
            exit;
        break;    
    case 'getForm':
            $templateModule = $templateModuleAjax;
            if ($type=='update'){
          	     $item = $objCatalog->getItem($id, $tabla);
                 $smarty->assign("item",$item);
            }
            $smarty->assign("id",$id);
            $smarty->assign("accion",$type);
                    $smarty->assign("dataConfig",$objItem->getDataConfig($tabla));
                    $smarty->assign("dataConfigDescripcion",$objItem->getDataConfigDescripcion($tabla));
                    $smarty->assign("dataConfigTipo",$objItem->getDataConfigTipo($tabla));
                    $smarty->assign("tablaGuardar",$tabla);             
                    $smarty->assign("listas",array("tipoId"=>$objCatalog->getDatosListas("vrhr_catalogo.cultivo_tipo"),
                                                    "provinciaId"=>$objCatalog->getDatosListas("vrhr_territorio.provincia"),
                                                    "regionId"=>$objCatalog->getDatosListas("vrhr_territorio.region"),
                                                    "departamentoId"=>$objCatalog->getDatosListas("vrhr_territorio.departamento"),
                                                    "componenteId"=>$objCatalog->getDatosListas("vrhr_proyecto.catalogo_componente"))); 
            $templateForm = $smarty->fetch($templateForm);
            echo $templateForm;
            exit;
        break;
    case 'getTabla': 
            $templateModule = $templateModuleAjax;
            $smarty->assign("listTablas",$objCatalog->getTablas($key));

            $templateCatalogos = $smarty->fetch($templateCatalogos);
            echo $templateCatalogos;
            exit;
        break;
        
    case 'getDatos': 
            $templateModule = $templateModuleAjax;
            $smarty->assign("listDatos",$objCatalog->getDatos($catalogo));
            $smarty->assign("tablaGuardar",$catalogo); 
            $templateDatos = $smarty->fetch($templateDatos);
            echo $templateDatos;
            exit;
    break;
            
    /**
     * Página por defecto
     */
    default: 
             $smarty->assign("subpage",$templateIndex);
                        
              $smarty->assign("ListCategoria", $objCatalog->getCategorias());               
             /*$smarty->assign("parentPadre",$parentPadre);
             $smarty->assign("parentEntidad",$parentEntidad);
             $smarty->assign("id",$id);*/
           /*
             $listGestiones = $objCatalog->getGestiones();*/
                         
              
    break;
}
