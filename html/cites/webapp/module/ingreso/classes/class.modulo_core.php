<?php

/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:23
 */

class Modulo_Core extends Table {

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    function privface_extender(){
        global $privFace,$smarty;
        /**
         * Consulta a la tabla local, de usuario_permisos
         */
        $sql ="";


        /**
         * reconstruir
         */
        $privFace["siguiente"] = 1;
        $privFace["devolver"] = 1;
        $privFace["ver"] = 1;
        $privFace["editar"] = 1;


        if($privFace["editar"]==0){

            $privFace["checkbox"] = " disabled='true' ";
            $privFace["input"] = " disabled='true' ";
        }


        $smarty->assign("privFace", $privFace);
    }
}