<?php
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
            $_SESSION["exit"] = "/ingreso";
            $url = 'Location: /cites';
            header($url);
            exit;
        }
        /**
         * usamos el template para mootools
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;
}