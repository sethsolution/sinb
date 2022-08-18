<?PHP


class CoreModule extends Table {

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
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
        $privFace["edit"] = 1;


        if($privFace["edit"]==0){

            $privFace["checkbox"] = " disabled='true' ";
            $privFace["input"] = " disabled='true' ";
        }


        $smarty->assign("privFace", $privFace);
    }
}