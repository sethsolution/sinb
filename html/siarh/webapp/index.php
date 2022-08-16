<?php
/**
 * Inicio del sistema, vaida login, cierre de sesion, ejecucion de m�dulos, cierre por tiempo limite
 */
include ("./inc/inc.php");

$tiempo = intval(( time()-$_SESSION["start"]) / 60);

if ($action == "login" || 
    $action == "close" ||
    $tiempo>=$CFG->idle_timeout
    ){
    include_once("./lib/core/login.class.php");
    $loginUser = new  Login;
}

/**
 * Controles del sistema inicial
 */
if ($action == "login"){
    $resp = $loginUser->userAuthenticate($_POST["user"],$_POST["password"]);
    echo $_SESSION["error"];
/**
 * Una vez que se guardan los registro de cierre de sesion
 * y se borre la sesion, el sistema nos enviara  a la pagina de inicio
 */
}else if ($action == "close"){
    if(isset($_SESSION["auth"])){
    $loginUser->closeSession(1); }
    ?><script>location="index.php";</script><?
/**
 * Si no existe la session y nos encontramos en otra
 * pagina, el sistema nos envia a la pagina de inicio
 */
}else if (isset($_SESSION["auth"]) and $_SESSION["auth"] != 1){
    ?><script>parent.location="index.php";</script><?
/**
 * Si la sesion existe y el ingreso al sistema fue correcto,
 * estamos listos para utilizar los modulos
 * 
 * en otro caso, si el tiempo de inactividad sobrepasa al configurado
 * se cerrara la sesion.
 */
}else if ( isset($_SESSION["auth"]) and $_SESSION["auth"] == 1){
    
    if( $tiempo<$CFG->idle_timeout ){
        include_once($CFG->homeSis."sisweb.php");
    }else{
        $loginUser->closeSession(2);
        ?><script>location="index.php";</script><?
    }
/**
 * Si la session es correcta, pero el tiempo a exedido el tiempo de vida de la session
 * el sistema nos envia al cierre de session
 */
}else{
    if($CFG->snir == true){
        $loginpage = "login.tpl";
    }else{
        //$loginpage = "sirh/login.tpl";
        $loginpage = "siarh-metro/login.tpl";
    }
    $smarty->display($loginpage);
}