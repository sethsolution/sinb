<?php
/**
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:27
 */


switch($accion) {
    /**
     * Página por defecto
     */
    default:
        /**
         *
         * Forzamos a que el login se realice desde el modulo de logín
         */
        if(!$_SESSION[auth]){
            $_SESSION["exit"] = "/ingreso";
            $url = 'Location: /ingreso';
            header($url);
            exit;
        }
        if($_SESSION["userv"]["tipoUsuario"]==2){
            header('Location: /cites');
            exit;
        }
        /**
         * usamos el template para mootools
         */
        $menu_modulo_principal = $objItem->get_menu_principal();
        $smarty->assign("menu_modulo_principal", $menu_modulo_principal);
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

    /**
     * Creación de JSON
     */
    case 'getPhoto':
        $objItem->getPhoto($type);
        break;

}