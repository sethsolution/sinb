<?PHP
use Core\Core;
/**
 * Configuración de Rutas
 */
/**
 * Verificamos si la primera llamada hace referencia a un snippet
 * snippet = nombre_
 */
$countOpt = 1;
$variables = APP_VARS;

if(isset($_REQUEST["type"])){$type = $_REQUEST["type"];}
if(isset($_REQUEST["filter"])){$filter = $_REQUEST["filter"];}

if(is_array($variables) && count($variables) > 0 and trim($variables[0])!=""){

    if(!is_numeric($variables[0])){
        $accion_par = explode("_",$variables[0]);
        $countOpt = count($accion_par);
        if($countOpt == 2) $subcontrol = $accion_par[0];
    }
    /**
     * Para los snippets que no son index
     */
    if($countOpt==2){
        $elemento = false;
        /**
         * Si el primer elemento es
         */
        if(is_numeric($variables[1])){
            $id = trim($variables[1]);
            if(!isset($type) and $type ==""){
                $type = "update";
            }
            $elemento0 = true;
        }else if($variables[1]=="new"){
            $type = "new";
            $elemento0 = true;
        }
        //echo $type."<----------------<br>";
        if(is_numeric($variables[2])){
            $id2 = trim($variables[2]);
            $accion = "get.form";
            $type = "update";
            $elemento = true;

        }else if($variables[2]=="new"){
            $accion = "get.form";
            $type = "new";
            $elemento = true;
        }
        /**
         * Si el segundo elemento existe y el primero es número
         * es una acción que afectará a un item
         */
        /**/
        if ($elemento){
            if(trim($variables[3])!=""){
                if(isset($variables[3]) and $variables[3]!=""){
                    $accion = $variables[3];
                }
                //unset($type);
            }
        }else{
            if(isset($variables[2]) and $variables[2]!=""){
                $accion = $variables[2];
            }
        }
        if ($elemento0) {

            if (trim($variables[1]) != "") {
                if (isset($variables[1]) and $variables[1] != "" and !is_numeric($variables[1])) {
                    $accion = $variables[1];
                }
            }
        }else{
            if(isset($variables[1]) and $variables[1]!="" and !isset($variables[3]) and !is_numeric($variables[1]) ){
                $accion = $variables[1];
            }
        }
        /**
         * Para el Snippet que si es index
         */
        $accion_par[1]= $accion;
    }else{
        $elemento = false;
        /**
         * Si el primer elemento es
         */
        if(is_numeric($variables[0])){
            $id = trim($variables[0]);
            $accion = "itemUpdate";
            $type = "update";
            $elemento = true;
        }else if($variables[0]=="new"){
            $accion = "itemUpdate";
            $type = "new";
            $elemento = true;
        }
        /**
         * Si el segundo elemento existe y el primero es número
         * es una acción que afectará a un item
         */
        if ($elemento){
            if(trim($variables[1])!=""){
                $accion = $variables[1];
            }
        }else{
            $accion = $variables[0];
        }
    }
    /**
     * Modificamos la forma de ingresar
     */
    $path_gestion = true;
}
$path_url = "/".APP."/".APP_MODULE;
$smarty->assign("path_url", $path_url);

/**
 * itemId sacamos de la url enviada
 */
if(isset($id) and $id != ""){
    $item_id =  $id;
}


$action = $accion;
/*/
print_struc($_REQUEST);
print_struc($variables);
print_struc($_REQUEST);
echo "$ accion: ".$accion."<br>";
echo "$ id: ".$id."<br>";
echo "$ id2: ".$id2."<br>";
echo "$ type: ".$type."<br>";
print_struc($ruta);
exit;
/**/