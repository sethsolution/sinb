<?php
/**/
function err_handler ($errno, $errstr, $errfile, $errline) {
        global $display_errors;
        if(($errno != E_NOTICE && $errno != E_WARNING)&& $display_errors) {
                echo("<font face='Tahoma' size=2>
                <hr size=1 color=black>
                <b>Error [$errno]:      $errstr</b><br>
                File: ".basename($errfile)."<br>
                Line: $errline<br>
                <hr size=1 color=black>
                </font>");
        }
}
/**/
//===============================================================
//= Lineas que permite que la configuraci�n se php se encuentre =
//= en off para la variable global                              =
//===============================================================
/**/
$error_flags = E_ALL & ~E_NOTICE;
@error_reporting($error_flags);
@ini_set ('error_reporting', $error_flags);
$old_error_handler = set_error_handler("err_handler");
/**/
$phpver = phpversion();
$phpver = doubleval($phpver[0].".".$phpver[2]);
if($phpver >= 4.1) {
    extract($_POST,EXTR_SKIP);
    extract($_GET,EXTR_SKIP);
    extract($_SERVER,EXTR_SKIP);
    extract($_FILES);
    $ENV_COOKIE = $_COOKIE;
} else {
    function array_key_exists($key,&$array) {
        reset($array);
        while(list($k,$v) = each($array)) {
            if($k == $key) {
                reset($array);
                return true;
            }
        }
        reset($array);
        return false;
    }
    $ENV_COOKIE = $HTTP_COOKIE_VARS;
}
/**/
//=============================================================
//= Funcion que imprime un arreglo con todo su contenido      =
//=============================================================
function print_struc($obj) {
	echo("<pre>");
	print_r($obj);
	echo("</pre>");
}

function postgisConnect(){
    global $dbsig,$CFGm,$core,$CFG;
    
    if($CFG->bPosgresql){
    if( !isset($dbsig->_resultid) ){
        $dbsig = ADONewConnection($CFGm->dbTypeSig);
        $resp = $dbsig->PConnect($CFGm->dbServerSig,$CFGm->dbUserSig,$CFGm->dbPasswordSig,$CFGm->dbDatabaseSig);
        if (!$resp){
            $core->errordb_log("postgre",$dbsig->ErrorMsg(),__FILE__,__LINE__);
        }
    }else{

        if (!$dbsig->IsConnected()){
            $core->errordb_log("postgre","Perdio la conexi�n: ".$dbsig->ErrorMsg(),__FILE__,__LINE__);
        }
    }
    }
}