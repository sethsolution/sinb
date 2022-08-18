<?PHP
use Core\Core;
$smarty = new Smarty();
/**
 * Verificamos si los directorio, se encuentrancreados
 * en caso que no estencreados, el sistema iniciara
 * con la creacion de los mismos.
 */
$smarty->compile_dir = $_ENV['DATA_FILE']."smarty/template/";

if(!file_exists($smarty->compile_dir)) {
    Core::createDirectory($_ENV['DATA_FILE']);
    Core::createDirectory($_ENV['DATA_FILE']."smarty/");
    Core::createDirectory($smarty->compile_dir);
}
/**
 * Genera carpetas contenedoras de usuarios cada 1000 usuarios
 */
if(isset($_SESSION["userv"]["id"])){
    $userFolder = Core::getUserDirectory($_SESSION["userv"]["id"]);
    $smarty->cache_dir = $userFolder."cache/";
    Core::createDirectory($smarty->cache_dir);
}

/**
 * DEBUG SOBRE SMARTY
 */
if ($_ENV['SMARTY_DEBUG']){
	$smarty->compile_check = true;
	$smarty->debugging = true;
}


$msg_core = array();
$msg_core["soporte_numero"]= "67072444";
$msg_core["soporte_email"] = "contacto@seth.com.bo";
$msg_core["soporte_whatsapp"] = "http://web.whatsapp.com";
$smarty->assign("msg_core",$msg_core);
return $smarty;

