<?PHP
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 17/06/2020
 * Time: 19:14
 */



switch($accion) {
    /**
     * Página por defecto
     */
    default:
        if($_SESSION[auth]){
            $_SESSION["exit"] = "/login";
            $url = 'Location: /cites';
            header($url);
            exit;
        }
        /**
         * usamos el template para mootools
         */
        $smarty->assign("c", $c);
        $smarty->assign("e", $e);
        $verifica = $objItem->verifica($c,$e);

        if ($verifica["itemId"]!=""){
            $encontro = 1;
        }else{
            $encontro = 2;
        }
        $smarty->assign("encontro", $encontro);

        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;


    case 'enviar':
        $smarty->assign("subpage", $webm["email"]);
        $res = $objItem->restablece($user);
        Core::printJson($res);
        break;
}